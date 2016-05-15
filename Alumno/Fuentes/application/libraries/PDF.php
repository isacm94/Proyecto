<?php

if (!defined('BASEPATH'))
    exit('No se permite el acceso directo al script');

/**
 * Clase que extiende de FPDF, librería que permite crear documentos PDF
 */
class PDF extends FPDF {

    protected $col = 0; // Columna actual
    protected $y0;      // Ordenada de comienzo de la columna

    /**
     * Cabecera de página
     */

    function Header() {
        // Logo
        $this->Image('assets/images/favicon.png', 10, 8, 15, 15);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Título
        $this->SetY(18);
        $this->SetX(30);
        $this->Cell(100, 0, utf8_decode("Shop's Admin"), 0, 2);
        // Salto de línea
        $this->Ln(10);
    }

    /**
     * Pie de página
     */
    function Footer() {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    /**
     * Crea la tabla con los datos detallados de cada producto comprado
     * @param Array $data Datos de los productos
     */
    function CreaAlbaran($data, $albaran) {
        $this->SetFont('Arial', '', 10);
        $this->Ln(10);
        //CABECERA tabla     
        $this->SetFillColor(255); //Fondo en blanco
        $this->SetTextColor(0); //color letra negro
        $this->SetDrawColor(196, 196, 196); //borde en gris
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        //Datos
        $header = array('Producto', 'Precio', 'IVA Aplicado', 'Cantidad', 'Total');
        $w = array(83, 25, 27, 30, 25);
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'L', true);
        $this->Ln();

        $this->SetFillColor(223, 223, 223); //gris
        $this->SetTextColor(0); //Color letra blanco
        $this->SetFont('', '', 10);

        // Datos
        $fill = true; //Para que empiece en gris la fila
        foreach ($data as $row) {
            $this->Cell($w[0], 6, utf8_decode($row['nombreproducto']), '1', 0, 'L');
            $this->Cell($w[1], 6, utf8_decode(round($row['precio'], 2)) . " " . iconv('UTF-8', 'windows-1252', '€'), '1', 0, 'L');
            $this->Cell($w[2], 6, utf8_decode(round($row['iva'], 2)) . "%", '1', 0, 'L');
            $this->Cell($w[3], 6, utf8_decode($row['cantidad']), '1', 0, 'L');
            $this->Cell($w[4], 6, utf8_decode(round($row['importe'], 2)) . " " . iconv('UTF-8', 'windows-1252', '€'), '1', 0, 'L');
            $this->Ln();
            if ($this->GetY() > 264) {
                $this->AddPage();
            }
            $fill = !$fill;
        }

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(95, 8, utf8_decode('Cantidad total: ' . $albaran['cantidad_total']), '1', 0, 'L');
        $this->Cell(95, 8, utf8_decode('Importe total: ' . round($albaran['importe_total'], 2)) . " " . iconv('UTF-8', 'windows-1252', '€'), '1', 0, 'L');

        if ($this->GetY() > 264) {
            $this->AddPage();
        }
    }

    /**
     * Crea la tabla de los datos generales del pedido
     * @param Array $data Datos del pedido
     */
    function CreaTablaPedido($data) {
        $CI = get_instance();
        //CABECERA tabla
        // Colores, ancho de línea y fuente en negrita        
        $this->SetFillColor(26, 188, 156); //Verde agua
        $this->SetTextColor(255);
        $this->SetDrawColor(255, 255, 255);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        //Datos
        $header = array('IMPORTE TOTAL', 'CANTIDAD TOTAL', 'ESTADO', 'FECHA PEDIDO');
        $w = array(50, 50, 40, 50);

        $this->Cell($w[0], 7, utf8_decode($header[0]), 1, 0, 'C', true);
        $this->Cell($w[1], 7, utf8_decode($header[1]), 1, 0, 'C', true);
        $this->Cell($w[2], 7, utf8_decode($header[2]), 1, 0, 'C', true);
        $this->Cell($w[3], 7, utf8_decode($header[3]), 1, 0, 'C', true);
        $this->Ln();

        //CUERPO
        // Restauración de colores y fuentes
        $this->SetFillColor(223, 223, 223); //gris
        $this->SetTextColor(0);
        $this->SetFont('', '', 10);

        // Datos
        $CI = & get_instance();
        $CI->load->helper('Fechas');

        $fill = true; //Para que salga en gris la fila              

        $this->Cell($w[0], 6, utf8_decode(round($data['importe'] * $CI->session->userdata('rate'), 2)) . " " . $CI->session->userdata('currency'), 'LR', 0, 'L');
        $this->Cell($w[1], 6, utf8_decode($data['cantidad_total'] . " camisetas"), 'LR', 0, 'L');
        $this->Cell($w[2], 6, utf8_decode($data['estado']), 'LR', 0, 'L');
        $this->Cell($w[3], 6, utf8_decode(cambiaFormatoFecha($data['fecha_pedido'])), 'LR', 0, 'L');

        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
        $this->Ln(10); //Salto de linea   
    }

    function SetCol($col) {
        // Establecer la posición de una columna dada
        $this->col = $col;
        $x = 10 + $col * 65;
        $this->SetLeftMargin($x);
        $this->SetX($x);
    }

}
