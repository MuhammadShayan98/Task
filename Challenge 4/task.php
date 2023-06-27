<?php

class GroupByOwnersService
{
    public function groupByOwners(array $files): array
    {
        $result = [];
        
        foreach ($files as $file => $owner) {
            $result[$owner][] = $file;
        }
        
        return $result;
    }
}

// Usage example
$files = [
    "insurance.txt" => "Company A",
    "letter.docx" => "Company A",
    "Contract.docx" => "Company B"
];

$groupByOwnersService = new GroupByOwnersService();
$groupedFiles = $groupByOwnersService->groupByOwners($files);

print_r($groupedFiles);