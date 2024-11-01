<?php

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
use Symfony\Component\HttpKernel\KernelInterface;

#[AsCommand(
    name: 'app:export-products',
    description: 'Exports all products to an Excel file and sends it via email',
)]
class ExportProductsCommand extends Command
{
    private ExcelExportService $excelExportService;
    private EmailService $emailService;
    private string $projectDir;

    public function __construct(ExcelExportService $excelExportService, EmailService $emailService, KernelInterface $kernel)
    {
        $this->excelExportService = $excelExportService;
        $this->emailService = $emailService;
        $this->projectDir = $kernel->getProjectDir(); 

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // Crear la consulta para obtener los productos
        $query = new GetAllProducts();
  
        $timestamp = Carbon::now()->format('Y_m_d_H_i_s');
        $exportDir = sprintf('%s/var/exports', $this->projectDir);
    
        // Verifica si el directorio existe, si no lo crea
        if (!is_dir($exportDir)) {
            mkdir($exportDir, 0755, true);
        }
    
        $filePath = sprintf('%s/report_%s.xlsx', $exportDir, $timestamp);

        $this->excelExportService->generateExcelFromQuery($query, $filePath);

        $recipient = 'recipient@example.com';
        $subject = 'Reporte de productos';
        $data = [
            'reportName' => sprintf('Reporte de Productos - %s', $timestamp), 
            'dateTime' => Carbon::now(), 
        ];         
        
        $template = 'emails/report.html.twig'; 
        $attachments = [$filePath]; 

        $this->emailService->send($template, $data, $recipient, $subject, $attachments);

        $io->success(sprintf('Excel report generated and emailed to: %s', $recipient));

        return Command::SUCCESS;
    }
}

