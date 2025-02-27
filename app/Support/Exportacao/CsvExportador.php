<?php

namespace App\Support\Exportacao;

abstract class CsvExportador
{
    protected array $headers = [];

    protected function __construct(
        protected string $filename,
        protected array $colunas,
        protected array $relatorioDados,
    ) {
        $this->headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '.csv"',
        ];
    }

    protected function exportar()
    {
        return response()->stream(function () {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, $this->colunas);

            foreach ($this->relatorioDados as $dado) {
                fputcsv($handle, $dado);
            }

            fclose($handle);
        }, 200, $this->headers);
    }
}
