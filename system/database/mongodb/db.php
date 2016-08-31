<?php

/**
 * Reference: https://mongodb.github.io/mongo-php-driver/crud/
 */
class DB {

    private $document;
    private $wc; //write concern
    private $rp; //read preference
    private $manager; //MongoDB Manager

    public function DB() {
        $this->manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    }

    public function connect() {
        
    }

    public function create() {
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->insert($this->document);

        try {
            /* Specify the full namespace as the first argument, followed by the bulk
             * write object and an optional write concern. MongoDB\Driver\WriteResult is
             * returned on success; otherwise, an exception is thrown. */
            $result = $this->manager->executeBulkWrite("db.collection", $bulk, $this->wc);
            return $result;
        } catch (MongoDB\Driver\Exception\Exception $e) {
            return $e->getMessage();
        }
    }

    public function read() {
        /* Construct a query with an empty filter (i.e. "select all") */
        $query = new MongoDB\Driver\Query([]);

        try {
            /* Specify the full namespace as the first argument, followed by the query
             * object and an optional read preference. MongoDB\Driver\Cursor is returned
             * success; otherwise, an exception is thrown. */
            $cursor = $this->manager->executeQuery("db.collection", $query, $this->rp);

            // Iterate over all matched documents
            foreach ($cursor as $document) {
                var_dump($document);
            }
        } catch (MongoDB\Driver\Exception\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update() {
        // Specify the search criteria and update operations (or replacement document)
        $filter = ["hello" => "world"];
        $newObj = ['$set' => ["hello" => "wonderful world"]];

        /* Specify some command options for the update:
         *
         *  * multi (boolean): Updates all matching documents when true; otherwise, only
         *    the first matching document is updated. Defaults to false.
         *  * upsert (boolean): If there is no matching document, create a new document
         *    from $filter and $newObj. Defaults to false.
         */
        $options = ["multi" => true, "upsert" => false];

        // Create a bulk write object and add our update operation
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->update($filter, $newObj, $options);

        try {
            /* Specify the full namespace as the first argument, followed by the bulk
             * write object and an optional write concern. MongoDB\Driver\WriteResult is
             * returned on success; otherwise, an exception is thrown. */
            $result = $this->manager->executeBulkWrite("db.collection", $bulk, $this->wc);
            return $result;
        } catch (MongoDB\Driver\Exception\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete() {
        // Specify the search criteria
        $filter = ["hello" => "world"];

        /* Specify some command options for the update:
         *
         *  * limit (integer): Deletes all matching documents when 0 (false). Otherwise,
         *    only the first matching document is deleted. */
        $options = ["limit" => 1];

        // Create a bulk write object and add our delete operation
        $bulk = new MongoDB\Driver\BulkWrite;
        $bulk->delete($filter, $options);

        try {
            /* Specify the full namespace as the first argument, followed by the bulk
             * write object and an optional write concern. MongoDB\Driver\WriteResult is
             * returned on success; otherwise, an exception is thrown. */
            $result = $this->manager->executeBulkWrite("db.collection", $bulk, $this->wc);
            return $result;
        } catch (MongoDB\Driver\Exception\Exception $e) {
            return $e->getMessage();
        }
    }

}
