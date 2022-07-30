<?php defined('_JEXEC') or die;

require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class FormControllerTrialVersions extends JControllerAdmin
{
    protected array $head = [
        'ID',
        'Дата запроса',
        'Компания',
        'Адрес',
        'ИНН / УНП',
        'Контактное лицо',
        'Телефон',
        'Email',
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
        $name = 'TrialVersions',
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
        foreach ($items as $key => $item) {
            $i = 0;
            foreach ($item as $value) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue(
                    $this->alphabet[$i++] . ($key + 2),
                    $value
                );
            }
        }
        $spreadsheet->getActiveSheet()->setTitle('Form');
        $spreadsheet->setActiveSheetIndex(0);
        header(
            'Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );
        header('Content-Disposition: attachment;filename="form.xlsx"');
        header('Cache-Control: max-age=0');
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

}