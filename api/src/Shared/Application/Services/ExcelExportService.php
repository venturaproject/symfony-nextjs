<?php

declare(strict_types=1);

namespace App\Shared\Application\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Shared\Application\Bus\Query\QueryBus;

class ExcelExportService
{
    private QueryBus $queryBus;
    private string $fileName;

    public function __construct(QueryBus $queryBus, string $fileName = 'report.xlsx')
    {
        $this->queryBus = $queryBus;
        $this->fileName = $fileName;
    }

    public function generateExcelFromQuery(object $query, string $path): void
    {
        // Ejecuta la consulta para obtener los datos
        $dataCollection = $this->queryBus->handle($query)->toArray(); // Convertimos el DTO a array
    
        // Crea el archivo Excel en memoria
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Detecta los encabezados automáticamente
        if (!empty($dataCollection)) {
            $headers = array_keys($dataCollection[0]); // Usamos el primer elemento para obtener los encabezados
            $col = 'A';
    
            // Escribe los encabezados
            foreach ($headers as $header) {
                $sheet->setCellValue("{$col}1", ucfirst((string)$header)); // Asegúrate de que el header sea un string
                $col++;
            }
    
            // Escribe los datos
            $row = 2;
            foreach ($dataCollection as $item) {
                $col = 'A';
                foreach ($item as $value) {
                    $sheet->setCellValue("{$col}{$row}", $value);
                    $col++;
                }
                $row++;
            }
        }
    
        // Guarda el archivo Excel en el sistema de archivos
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);
    }
    
    
    
}
