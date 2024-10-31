<?php

declare(strict_types=1);

declare(strict_types=1);

namespace App\Products\Application\Console;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Shared\Application\Services\ExcelExportService;
use App\Shared\Application\Services\EmailService;
use App\Products\Application\Queries\GetAll\GetAllProducts;
use Carbon\Carbon;

#[AsCommand(
    name: 'app:export-products',
    description: 'Exports all products to an Excel file and sends it via email',
)]
class ExportProductsCommand extends Command
{
    private ExcelExportService $excelExportService;
    private EmailService $emailService;

    public function __construct(ExcelExportService $excelExportService, EmailService $emailService)
    {
        $this->excelExportService = $excelExportService;
        $this->emailService = $emailService;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Crear la consulta para obtener los productos
        $query = new GetAllProducts();
        
        // Generar el nombre y la ruta del archivo Excel con marca de tiempo
        $timestamp = Carbon::now()->format('Y_m_d_H_i_s');
        $projectDir = $this->getApplication()->getKernel()->getProjectDir();
        $exportDir = sprintf('%s/var/exports', $projectDir);
    
        // Verifica si el directorio existe, si no lo crea
        if (!is_dir($exportDir)) {
            mkdir($exportDir, 0755, true);
        }
    
        $filePath = sprintf('%s/report_%s.xlsx', $exportDir, $timestamp);
        // Generar el archivo Excel
        $this->excelExportService->generateExcelFromQuery($query, $filePath);

        // Configurar los datos para el correo electrónico
        $recipient = 'recipient@example.com';
        $subject = 'Reporte de productos';
        $data = [
            'reportName' => sprintf('Reporte de Productos - %s', $timestamp), 
            'dateTime' => Carbon::now(), 
        ];         
        
        $template = 'emails/report.html.twig'; 
        $attachments = [$filePath]; 

        // Enviar el email con el archivo adjunto
        $this->emailService->send($template, $data, $recipient, $subject, $attachments);

        // Confirmación en consola
        $io->success(sprintf('Excel report generated and emailed to: %s', $recipient));

        return Command::SUCCESS;
    }
}

