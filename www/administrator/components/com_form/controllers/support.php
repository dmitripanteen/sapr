<?php defined('_JEXEC') or die;

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class FormControllerSupport extends JControllerAdmin
{
    protected array $head = [
        'ID',
        'Дата запроса',
        'Компания',
        'Телефон',
        'Email',
        'Сообщение',
        'Файл 1',
        'Файл 2',
        'Файл 3',
        'Файл 4',
    ];

    protected array $alphabet = [
        'A',
        'B',
        'C',
        'D',
        'E',
        'F',
        'G',
        'H',
        'I',
        'J',
        'K',
        'L',
        'M',
        'N',
        'O',
        'P',
        'Q',
        'R',
        'S',
        'T',
        'U',
        'V',
        'W',
        'X',
        'Y',
        'Z'
    ];

    protected array $styleHeader = [
        'borders' => [
            'bottom' => [
                'borderStyle' => Border::BORDER_THIN,
                'color'       => ['rgb' => '000000']
            ],
            'left'   => [
                'borderStyle' => Border::BORDER_THIN,
                'color'       => ['rgb' => '000000']
            ],
            'top'    => [
                'borderStyle' => Border::BORDER_THIN,
                'color'       => ['rgb' => '000000']
            ],
            'right'  => [
                'borderStyle' => Border::BORDER_THIN,
                'color'       => ['rgb' => '000000']
            ],
        ],
        'fill'    => [
            'fillType' => Fill::FILL_SOLID,
            'color'    => ['rgb' => 'F58229'],
        ],
        'font'    => [
            'bold' => true,
        ]
    ];

    public function getModel(
        $name = 'Support',
        $prefix = 'FormModel',
        $config = array()
    ) {
        return parent::getModel(
            $name,
            $prefix,
            array('ignore_request' => true)
        );
    }

    public function printExcel()
    {
        $model = $this->getModel();
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator("CADElecto Website")
            ->setLastModifiedBy("CADElecto Website")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Form")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Form");
        foreach ($this->head as $key => $item) {
            $spreadsheet->getActiveSheet()->getColumnDimension(
                $this->alphabet[$key]
            )->setAutoSize(true);
            $spreadsheet->getActiveSheet()->getStyle(
                $this->alphabet[$key] . "1"
            )->applyFromArray($this->styleHeader);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                $this->alphabet[$key] . "1",
                $item
            );
        }
        $items = $model->getExportItems();
        $siteUrl = (
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
                ? "https"
                : "http"
            )
            . "://" . $_SERVER['HTTP_HOST'];
        foreach ($items as $key => $item) {
            $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                $this->alphabet[0] . ($key + 2),
                $item->id
            );
            $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                $this->alphabet[1] . ($key + 2),
                $item->request_date
            );
            $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                $this->alphabet[2] . ($key + 2),
                $item->company_name
            );
            $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                $this->alphabet[3] . ($key + 2),
                $item->phone
            );
            $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                $this->alphabet[4] . ($key + 2),
                $item->email
            );
            $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                $this->alphabet[5] . ($key + 2),
                $item->message
            );
            if($item->file1) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                    $this->alphabet[6] . ($key + 2),
                    basename($item->file1)
                );
                $spreadsheet->getActiveSheet()
                    ->getCell($this->alphabet[6] . ($key + 2))
                    ->getHyperlink()
                    ->setUrl($siteUrl . $item->file1)
                    ->setTooltip('Открыть файл');
            }
            if($item->file2) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                    $this->alphabet[7] . ($key + 2),
                    basename($item->file2)
                );
                $spreadsheet->getActiveSheet()
                    ->getCell($this->alphabet[7] . ($key + 2))
                    ->getHyperlink()
                    ->setUrl($siteUrl . $item->file2)
                    ->setTooltip('Открыть файл');
            }
            if($item->file3) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                    $this->alphabet[8] . ($key + 2),
                    basename($item->file3)
                );
                $spreadsheet->getActiveSheet()
                    ->getCell($this->alphabet[8] . ($key + 2))
                    ->getHyperlink()
                    ->setUrl($siteUrl . $item->file3)
                    ->setTooltip('Открыть файл');
            }
            if($item->file4) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                    $this->alphabet[9] . ($key + 2),
                    basename($item->file4)
                );
                $spreadsheet->getActiveSheet()
                    ->getCell($this->alphabet[9] . ($key + 2))
                    ->getHyperlink()
                    ->setUrl($siteUrl . $item->file4)
                    ->setTooltip('Открыть файл');
            }
        }
        $spreadsheet->getActiveSheet()->setTitle('Form');
        $spreadsheet->setActiveSheetIndex(0);
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment;filename="support.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

}