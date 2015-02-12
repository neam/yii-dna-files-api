<?php

/**
 * Command for syncing files to s3
 */
class SyncFilesCommand extends CConsoleCommand
{

    use DnaConsoleCommandTrait;

    public function actionSyncUp($pageSize = 5, $currentPage = 1, $verbose = false)
    {
        foreach (DataModel::permalinkableFiles() as $modelRef => $attributes) {
            $this->status("$modelRef");
            $this->actionPush($modelRef, $pageSize, $currentPage);
        }
    }

    public function actionPush($modelRef, $pageSize = 5, $currentPage = 1, $verbose = false)
    {

        echo "\n";
        $this->status("Loading controller and model");

        $this->status("Applying pagination etc and getting the current records");
        $criteria = $this->getCriteria($modelRef, $pageSize, $currentPage);

        $records = $modelRef::model()->getCommandBuilder()
            ->createFindCommand($modelRef::model()->tableSchema, $criteria)
            ->queryAll();

        /* TODO: Implement a more intelligent initial query similar to the one below so that all items does not need to be traversed
SELECT
    media.*, file_route.*
FROM
    vector_graphic item
        INNER JOIN
    file_route ON canonical = 1
        AND file_route.node_id = item.node_id
        INNER JOIN
    p3_media media ON item.original_media_id = media.id
WHERE
    (media.s3_bucket IS NULL
        OR media.s3_path IS NULL
        OR (media.s3_path != CONCAT('branch - prefix', file_route.route)
        OR media.s3_bucket != 'static.gapminder.org'))
    */

        foreach ($records as $k => $record) {
            try {
                $this->status("$modelRef id: " . $record["id"]);

                // Loads model only if published
                $publishedModel = $modelRef::model()->findByPk($record["id"]);

                // TODO: Possibly publish these but to a non-public or obscure location, so that we can preview the files
                if (!$publishedModel) {
                    $this->status("Skipping non-published $modelRef id: " . $record["id"]);
                    continue;
                }

                // Load model unrestricted
                $model = $modelRef::model()->unrestricted()->findByPk($record["id"]);

                $this->status("$modelRef loaded id: " . $model->id);

                $pushFilesToS3Results = $model->pushFilesToS3();

                $this->status("count(pushToS3Results): " . count($pushFilesToS3Results));
                $this->status("pushToS3Results: " . print_r($pushFilesToS3Results, true));

            } catch (Exception $e) {
                $this->exceptionStatus($e, true);
            }
        }

        $this->doneExecutionStatus($pageSize, $currentPage, $records);

        /*
        try {
            $item = $node->item();
        } catch (NodeItemExistsButIsRestricted $e) {
            return null;
        }
        */


    }

}
