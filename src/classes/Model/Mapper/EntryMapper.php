<?php

namespace SlimTest\Model\Mapper;

use SlimTest\Model\Entity\EntryEntity;

class EntryMapper extends AbstractMapper {

    public function getEntries() {
        $sql = "SELECT * FROM entries";
        $stmt = $this->dbConnection->query($sql);
        $results = [];
        while($row = $stmt->fetch()) {
            $results[] = new EntryEntity($row);
        }
        return $results;
    }
    /**
     * Get one entry by its ID
     *
     * @param int $entryId
     * @return EntryEntity
     */
    public function getEntryById($entryId) {
        $sql = "SELECT * FROM entries e WHERE e.id = :entry_id";
        /** @var \PDOStatement $stmt */
        $stmt = $this->dbConnection->prepare($sql);
        $result = $stmt->execute(["entry_id" => $entryId]);
        if($result) {
            return new EntryEntity($stmt->fetch());
        }
        return null;
    }
    public function save(EntryEntity $entry) {
        $sql = "INSERT INTO entries (title, description) VALUES (:title, :description)";
        /** @var \PDOStatement $stmt */
        $stmt = $this->dbConnection->prepare($sql);
        $result = $stmt->execute([
            "title" => $entry->getTitle(),
            "description" => $entry->getDescription(),
        ]);
        if(!$result) {
            throw new \Exception("could not save record");
        }
    }

    public function update(EntryEntity $entry) {
        $sql = "UPDATE entries e SET e.title = :title, e.description = :description WHERE e.id = :entry_id";
        /** @var \PDOStatement $stmt */
        $stmt = $this->dbConnection->prepare($sql);
        $result = $stmt->execute([
            "title" => $entry->getTitle(),
            "description" => $entry->getDescription(),
            'entry_id' => $entry->getId()
        ]);
        if(!$result) {
            throw new \Exception("could not update record");
        }
    }

    public function delete(EntryEntity $entry)
    {
        $sql = "DELETE FROM entries WHERE id = :entry_id";
        /** @var \PDOStatement $stmt */
        $stmt = $this->dbConnection->prepare($sql);
        $result = $stmt->execute([
            'entry_id' => $entry->getId()
        ]);
        if (!$result) {
            throw new \Exception("could not update record");
        }
    }
}