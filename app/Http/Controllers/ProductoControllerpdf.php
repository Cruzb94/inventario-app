<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf; // Importa la clase Fpdf desde el paquete

class ProductoControllerpdf extends Controller
{
    public function generarReportePDF(Request $request)
    {
        // Obtener los datos del cuerpo de la solicitud
        $tableData = json_decode($request->getContent(), true);

        // Crear una instancia de Fpdf
        $pdf = new Fpdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 5);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        // Cabecera del PDF
        $pdf->Image(public_path('img/waves.png'), -10, -1, 110);
        $pdf->Image(public_path('img/LWB.jpeg'), 150, 15, 25);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(0); // Posición para la fecha "Desde"
        $pdf->SetX(145); // Mover a la derecha
        $pdf->Cell(0, 8, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
        $pdf->SetY(40);
        $pdf->SetX(137);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(89, 8, 'REPORTE DE SALIDAS', 0, 1);
        $pdf->SetY(45);
        $pdf->SetX(148);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(40, 8, utf8_decode('Tu tienda de confianza'));
        $pdf->Ln(30);

        $pdf->SetX(35);
        $pdf->SetFillColor(127, 13, 129, 255); // Color de fondo para los encabezados
        $pdf->SetTextColor(255, 255, 255); // Color de texto para los encabezados
        
        // Encabezados de la tabla
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(45, 12, utf8_decode('Referencia'), 0, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Descripción'), 0, 0, 'C', 1);
        $pdf->Cell(40, 12, utf8_decode('Stock'), 0, 1, 'C', 1);
        
        $pdf->SetTextColor(0, 0, 0); // Restablecer el color de texto a negro para los datos
        $pdf->SetFont('Arial', '', 10); // Restablecer la fuente para los datos
        
        foreach ($tableData as $index => $row) {
            $pdf->SetX(35);
            
            // Establecer el color de relleno según el índice de la fila
            if ($index % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232); // Color gris claro para filas pares
            } else {
                $pdf->SetFillColor(255, 255, 255); // Color blanco para filas impares
            }
        
            // Celdas de datos
            $pdf->Cell(45, 8, utf8_decode($row[0]), 'B', 0, 'C', true); // Referencia
            $pdf->Cell(60, 8, utf8_decode($row[1]), 'B', 0, 'C', true); // Descripción
            $pdf->Cell(40, 8, utf8_decode($row[2]), 'B', 1, 'C', true); // Stock
        }

        // Pie de página
        $pdf->SetY(287); // Ajusta la posición Y para el pie de página
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetTextColor(0, 0, 0); // Cambiar el color del texto a negro
        $pdf->Cell(0, 5, utf8_decode("LEGO WOMAN BOUTIQUE © Todos los derechos reservados."), 0, 1, "C");

        $pdf->SetY(285); // Ajusta la posición Y para la línea horizontal
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Dibujar línea horizontal

        // Ajusta la posición Y nuevamente para los textos de fecha y paginación
        $pdf->SetY(280);
        $pdf->Cell(95, 5, date('d/m/Y | g:i:a'), 0, 0, 'L');
        $pdf->Cell(95, 5, utf8_decode('Página ') . $pdf->PageNo() . ' / {nb}', 0, 1, 'R');

        // Genera el contenido del PDF
        $output = $pdf->Output('S');

        // Envía el PDF generado al cliente
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="reporte.pdf"',
        ]);
    }
    public function generarReporte2PDF(Request $request)
    {
        // Obtener los datos del cuerpo de la solicitud
        $tableData = json_decode($request->getContent(), true);

       // dd( $tableData);

        // Crear una instancia de Fpdf
        $pdf = new Fpdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 5);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        // Cabecera del PDF
        $pdf->Image(public_path('img/waves.png'), -10, -1, 110);
        $pdf->Image(public_path('img/LWB.jpeg'), 150, 15, 25);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(0); // Posición para la fecha "Desde"
        $pdf->SetX(145); // Mover a la derecha
        $pdf->Cell(0, 8, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
        $pdf->SetY(40);
        $pdf->SetX(137);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(89, 8, 'REPORTE DE SALIDAS', 0, 1);
        $pdf->SetY(45);
        $pdf->SetX(148);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(40, 8, utf8_decode('Tu tienda de confianza'));
        $pdf->Ln(30);

        $pdf->SetX(15);
        $pdf->SetFillColor(127, 13, 129, 255); // Color de fondo para los encabezados
        $pdf->SetTextColor(255, 255, 255); // Color de texto para los encabezados
        
        // Encabezados de la tabla
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(35, 12, utf8_decode('Nombre'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Cedula-Nit'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Numero de contacto'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Direccion'), 0, 0, 'C', 1);
        $pdf->Cell(35, 12, utf8_decode('Fecha de ingreso'), 0, 1, 'C', 1);
        
        $pdf->SetTextColor(0, 0, 0); // Restablecer el color de texto a negro para los datos
        $pdf->SetFont('Arial', '', 10); // Restablecer la fuente para los datos
        
        foreach ($tableData as $index => $row) {
            $pdf->SetX(15);
            
            // Establecer el color de relleno según el índice de la fila
            if ($index % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232); // Color gris claro para filas pares
            } else {
                $pdf->SetFillColor(255, 255, 255); // Color blanco para filas impares
            }
        
            // Celdas de datos
            $pdf->Cell(35, 8, utf8_decode($row[0]), 'B', 0, 'C', true); // Nombre
            $pdf->Cell(35, 8, utf8_decode($row[1]), 'B', 0, 'C', true); // Cedula-Nit
            $pdf->Cell(35, 8, utf8_decode($row[2]), 'B', 0, 'C', true); // Numero de contacto
            $pdf->Cell(35, 8, utf8_decode($row[3]), 'B', 0, 'C', true); // Direccion
            $pdf->Cell(35, 8, utf8_decode($row[4]), 'B', 1, 'C', true); // Fecha de ingreso
        }

        // Pie de página
        $pdf->SetY(287); // Ajusta la posición Y para el pie de página
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetTextColor(0, 0, 0); // Cambiar el color del texto a negro
        $pdf->Cell(0, 5, utf8_decode("LEGO WOMAN BOUTIQUE © Todos los derechos reservados."), 0, 1, "C");

        $pdf->SetY(285); // Ajusta la posición Y para la línea horizontal
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Dibujar línea horizontal

        // Ajusta la posición Y nuevamente para los textos de fecha y paginación
        $pdf->SetY(280);
        $pdf->Cell(95, 5, date('d/m/Y | g:i:a'), 0, 0, 'L');
        $pdf->Cell(95, 5, utf8_decode('Página ') . $pdf->PageNo() . ' / {nb}', 0, 1, 'R');

        // Genera el contenido del PDF
        $output = $pdf->Output('S');

        // Envía el PDF generado al cliente
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="reporte.pdf"',
        ]);
    }

    public function generarReporte3PDF(Request $request)
    {
        // Obtener los datos del cuerpo de la solicitud
        $tableData = json_decode($request->getContent(), true);

      //  dd( $tableData);

        // Crear una instancia de Fpdf
        $pdf = new Fpdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 5);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        // Cabecera del PDF
        $pdf->Image(public_path('img/waves.png'), -10, -1, 110);
        $pdf->Image(public_path('img/LWB.jpeg'), 150, 15, 25);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(0); // Posición para la fecha "Desde"
        $pdf->SetX(145); // Mover a la derecha
        $pdf->Cell(0, 8, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
        $pdf->SetY(40);
        $pdf->SetX(137);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(89, 8, 'REPORTE DE SALIDAS', 0, 1);
        $pdf->SetY(45);
        $pdf->SetX(148);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(40, 8, utf8_decode('Tu tienda de confianza'));
        $pdf->Ln(30);

        $pdf->SetX(35);
        $pdf->SetFillColor(127, 13, 129, 255); // Color de fondo para los encabezados
        $pdf->SetTextColor(255, 255, 255); // Color de texto para los encabezados
        
        // Encabezados de la tabla
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(45, 12, utf8_decode('Nombre'), 0, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Nombre del Banco'), 0, 0, 'C', 1);
        $pdf->Cell(40, 12, utf8_decode('Nro.cuenta'), 0, 1, 'C', 1);
        
        $pdf->SetTextColor(0, 0, 0); // Restablecer el color de texto a negro para los datos
        $pdf->SetFont('Arial', '', 10); // Restablecer la fuente para los datos
        
        foreach ($tableData as $index => $row) {
            $pdf->SetX(35);
            
            // Establecer el color de relleno según el índice de la fila
            if ($index % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232); // Color gris claro para filas pares
            } else {
                $pdf->SetFillColor(255, 255, 255); // Color blanco para filas impares
            }
        
            // Celdas de datos
            $pdf->Cell(45, 8, utf8_decode($row[0]), 'B', 0, 'C', true); // Nombre
            $pdf->Cell(60, 8, utf8_decode($row[1]), 'B', 0, 'C', true); // Nombre del Banco
            $pdf->Cell(40, 8, utf8_decode($row[2]), 'B', 1, 'C', true); // Nro.cuenta
        }

        // Pie de página
        $pdf->SetY(287); // Ajusta la posición Y para el pie de página
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetTextColor(0, 0, 0); // Cambiar el color del texto a negro
        $pdf->Cell(0, 5, utf8_decode("LEGO WOMAN BOUTIQUE © Todos los derechos reservados."), 0, 1, "C");

        $pdf->SetY(285); // Ajusta la posición Y para la línea horizontal
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Dibujar línea horizontal

        // Ajusta la posición Y nuevamente para los textos de fecha y paginación
        $pdf->SetY(280);
        $pdf->Cell(95, 5, date('d/m/Y | g:i:a'), 0, 0, 'L');
        $pdf->Cell(95, 5, utf8_decode('Página ') . $pdf->PageNo() . ' / {nb}', 0, 1, 'R');

        // Genera el contenido del PDF
        $output = $pdf->Output('S');

        // Envía el PDF generado al cliente
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="reporte.pdf"',
        ]);
    }
    public function generarReporte4PDF(Request $request)
    {
        // Obtener los datos del cuerpo de la solicitud
        $tableData = json_decode($request->getContent(), true);

      //  dd( $tableData);

        // Crear una instancia de Fpdf
        $pdf = new Fpdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 5);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        // Cabecera del PDF
        $pdf->Image(public_path('img/waves.png'), -10, -1, 110);
        $pdf->Image(public_path('img/LWB.jpeg'), 150, 15, 25);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(0); // Posición para la fecha "Desde"
        $pdf->SetX(145); // Mover a la derecha
        $pdf->Cell(0, 8, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
        $pdf->SetY(40);
        $pdf->SetX(137);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(89, 8, 'REPORTE DE SALIDAS', 0, 1);
        $pdf->SetY(45);
        $pdf->SetX(148);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(40, 8, utf8_decode('Tu tienda de confianza'));
        $pdf->Ln(30);

        $pdf->SetX(35);
        $pdf->SetFillColor(127, 13, 129, 255); // Color de fondo para los encabezados
        $pdf->SetTextColor(255, 255, 255); // Color de texto para los encabezados
        
        // Encabezados de la tabla
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(45, 12, utf8_decode('Nombre'), 0, 0, 'C', 1);
        $pdf->Cell(60, 12, utf8_decode('Email'), 0, 0, 'C', 1);
        $pdf->Cell(40, 12, utf8_decode('Rol'), 0, 1, 'C', 1);
        
        $pdf->SetTextColor(0, 0, 0); // Restablecer el color de texto a negro para los datos
        $pdf->SetFont('Arial', '', 10); // Restablecer la fuente para los datos
        
        foreach ($tableData as $index => $row) {
            $pdf->SetX(35);
            
            // Establecer el color de relleno según el índice de la fila
            if ($index % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232); // Color gris claro para filas pares
            } else {
                $pdf->SetFillColor(255, 255, 255); // Color blanco para filas impares
            }
        
            // Celdas de datos
            $pdf->Cell(45, 8, utf8_decode($row[0]), 'B', 0, 'C', true); // Nombre
            $pdf->Cell(60, 8, utf8_decode($row[1]), 'B', 0, 'C', true); // Email
            $pdf->Cell(40, 8, utf8_decode($row[2]), 'B', 1, 'C', true); // Rol
        }

        // Pie de página
        $pdf->SetY(287); // Ajusta la posición Y para el pie de página
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetTextColor(0, 0, 0); // Cambiar el color del texto a negro
        $pdf->Cell(0, 5, utf8_decode("LEGO WOMAN BOUTIQUE © Todos los derechos reservados."), 0, 1, "C");

        $pdf->SetY(285); // Ajusta la posición Y para la línea horizontal
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Dibujar línea horizontal

        // Ajusta la posición Y nuevamente para los textos de fecha y paginación
        $pdf->SetY(280);
        $pdf->Cell(95, 5, date('d/m/Y | g:i:a'), 0, 0, 'L');
        $pdf->Cell(95, 5, utf8_decode('Página ') . $pdf->PageNo() . ' / {nb}', 0, 1, 'R');

        // Genera el contenido del PDF
        $output = $pdf->Output('S');

        // Envía el PDF generado al cliente
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="reporte.pdf"',
        ]);
    }

    public function generarReporte5PDF(Request $request)
    {
        // Obtener los datos del cuerpo de la solicitud
        $tableData = json_decode($request->getContent(), true);

       // dd( $tableData);

        // Crear una instancia de Fpdf
        $pdf = new Fpdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 5);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        // Cabecera del PDF
        $pdf->Image(public_path('img/waves.png'), -10, -1, 110);
        $pdf->Image(public_path('img/LWB.jpeg'), 150, 15, 25);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(0); // Posición para la fecha "Desde"
        $pdf->SetX(145); // Mover a la derecha
        $pdf->Cell(0, 8, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
        $pdf->SetY(40);
        $pdf->SetX(137);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(89, 8, 'REPORTE DE SALIDAS', 0, 1);
        $pdf->SetY(45);
        $pdf->SetX(148);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(40, 8, utf8_decode('Tu tienda de confianza'));
        $pdf->Ln(30);

        $pdf->SetX(10);
        $pdf->SetFillColor(127, 13, 129, 255); // Color de fondo para los encabezados
        $pdf->SetTextColor(255, 255, 255); // Color de texto para los encabezados
        
        // Encabezados de la tabla
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(30, 12, utf8_decode('Fecha'), 0, 0, 'C', 1);
        $pdf->Cell(40, 12, utf8_decode('Cuenta_Bancolombia'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Nequi'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Bancolombia'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Efectivo'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Descripcion'), 0, 1, 'C', 1);
        
        $pdf->SetTextColor(0, 0, 0); // Restablecer el color de texto a negro para los datos
        $pdf->SetFont('Arial', '', 10); // Restablecer la fuente para los datos
        
        foreach ($tableData as $index => $row) {
            $pdf->SetX(10);
            
            // Establecer el color de relleno según el índice de la fila
            if ($index % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232); // Color gris claro para filas pares
            } else {
                $pdf->SetFillColor(255, 255, 255); // Color blanco para filas impares
            }
        
            // Celdas de datos
            $pdf->Cell(30, 8, utf8_decode($row[0]), 'B', 0, 'C', true); // Nombre
            $pdf->Cell(40, 8, utf8_decode($row[1]), 'B', 0, 'C', true); // Cedula-Nit
            $pdf->Cell(30, 8, utf8_decode($row[2]), 'B', 0, 'C', true); // Numero de contacto
            $pdf->Cell(25, 8, utf8_decode($row[3]), 'B', 0, 'C', true); // Direccion
            $pdf->Cell(30, 8, utf8_decode($row[4]), 'B', 0, 'C', true); // Fecha de ingreso
            $pdf->Cell(30, 8, utf8_decode($row[5]), 'B', 1, 'C', true); // Fecha de ingreso
        }

        // Pie de página
        $pdf->SetY(287); // Ajusta la posición Y para el pie de página
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetTextColor(0, 0, 0); // Cambiar el color del texto a negro
        $pdf->Cell(0, 5, utf8_decode("LEGO WOMAN BOUTIQUE © Todos los derechos reservados."), 0, 1, "C");

        $pdf->SetY(285); // Ajusta la posición Y para la línea horizontal
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Dibujar línea horizontal

        // Ajusta la posición Y nuevamente para los textos de fecha y paginación
        $pdf->SetY(280);
        $pdf->Cell(95, 5, date('d/m/Y | g:i:a'), 0, 0, 'L');
        $pdf->Cell(95, 5, utf8_decode('Página ') . $pdf->PageNo() . ' / {nb}', 0, 1, 'R');

        // Genera el contenido del PDF
        $output = $pdf->Output('S');

        // Envía el PDF generado al cliente
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="reporte.pdf"',
        ]);
    }
    public function generarReporte6PDF(Request $request)
    {
        // Obtener los datos del cuerpo de la solicitud
        $tableData = json_decode($request->getContent(), true);

       // dd( $tableData);

        // Crear una instancia de Fpdf
        $pdf = new Fpdf();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetAutoPageBreak(true, 5);
        $pdf->SetTopMargin(15);
        $pdf->SetLeftMargin(10);
        $pdf->SetRightMargin(10);

        // Cabecera del PDF
        $pdf->Image(public_path('img/waves.png'), -10, -1, 110);
        $pdf->Image(public_path('img/LWB.jpeg'), 150, 15, 25);
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(0); // Posición para la fecha "Desde"
        $pdf->SetX(145); // Mover a la derecha
        $pdf->Cell(0, 8, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');
        $pdf->SetY(40);
        $pdf->SetX(137);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(89, 8, 'REPORTE DE SALIDAS', 0, 1);
        $pdf->SetY(45);
        $pdf->SetX(148);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(40, 8, utf8_decode('Tu tienda de confianza'));
        $pdf->Ln(30);

        $pdf->SetX(10);
        $pdf->SetFillColor(127, 13, 129, 255); // Color de fondo para los encabezados
        $pdf->SetTextColor(255, 255, 255); // Color de texto para los encabezados
        
        // Encabezados de la tabla
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(30, 12, utf8_decode('Referencia'), 0, 0, 'C', 1);
        $pdf->Cell(40, 12, utf8_decode('Descripcion'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Fecha'), 0, 0, 'C', 1);
        $pdf->Cell(25, 12, utf8_decode('Cantidad'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Operario'), 0, 0, 'C', 1);
        $pdf->Cell(30, 12, utf8_decode('Reproceso'), 0, 1, 'C', 1);
        
        $pdf->SetTextColor(0, 0, 0); // Restablecer el color de texto a negro para los datos
        $pdf->SetFont('Arial', '', 10); // Restablecer la fuente para los datos
        
        foreach ($tableData as $index => $row) {
            $pdf->SetX(10);
            
            // Establecer el color de relleno según el índice de la fila
            if ($index % 2 == 0) {
                $pdf->SetFillColor(232, 232, 232); // Color gris claro para filas pares
            } else {
                $pdf->SetFillColor(255, 255, 255); // Color blanco para filas impares
            }
        
            // Celdas de datos
            $pdf->Cell(30, 8, utf8_decode($row[0]), 'B', 0, 'C', true); // Nombre
            $pdf->Cell(40, 8, utf8_decode($row[1]), 'B', 0, 'C', true); // Cedula-Nit
            $pdf->Cell(30, 8, utf8_decode($row[2]), 'B', 0, 'C', true); // Numero de contacto
            $pdf->Cell(25, 8, utf8_decode($row[3]), 'B', 0, 'C', true); // Direccion
            $pdf->Cell(30, 8, utf8_decode($row[4]), 'B', 0, 'C', true); // Fecha de ingreso
            $pdf->Cell(30, 8, utf8_decode($row[5]), 'B', 1, 'C', true); // Fecha de ingreso
        }

        // Pie de página
        $pdf->SetY(287); // Ajusta la posición Y para el pie de página
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->SetTextColor(0, 0, 0); // Cambiar el color del texto a negro
        $pdf->Cell(0, 5, utf8_decode("LEGO WOMAN BOUTIQUE © Todos los derechos reservados."), 0, 1, "C");

        $pdf->SetY(285); // Ajusta la posición Y para la línea horizontal
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Dibujar línea horizontal

        // Ajusta la posición Y nuevamente para los textos de fecha y paginación
        $pdf->SetY(280);
        $pdf->Cell(95, 5, date('d/m/Y | g:i:a'), 0, 0, 'L');
        $pdf->Cell(95, 5, utf8_decode('Página ') . $pdf->PageNo() . ' / {nb}', 0, 1, 'R');

        // Genera el contenido del PDF
        $output = $pdf->Output('S');

        // Envía el PDF generado al cliente
        return response($output, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="reporte.pdf"',
        ]);
    }
}