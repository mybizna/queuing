<?php

namespace Modules\Queuing\Classes;

use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintConnectors\RawbtPrintConnector;
use Mike42\Escpos\Printer;
use Modules\Queuing\Classes\Item;

class PrintTicket
{
    function print($ticket_number) {

        try {
            $profile = CapabilityProfile::load("POS-5890");

            /* Fill in your own connector here */
            $connector = new RawbtPrintConnector();

            /* Information for the receipt */
            $items = array(
                new Item("Example item #1", "4.00"),
                new Item("Another thing", "3.50"),
                new Item("Something else", "1.00"),
                new Item("A final item", "4.45"),
            );
            $subtotal = new Item('Subtotal', '12.95');
            $tax = new Item('A local tax', '1.30');
            $total = new Item('Total', '14.25', true);
            /* Date is kept the same for testing */
            $date = date('l jS m Y h:i:s A');
            //$date = "Monday 6th of April 2015 02:56:25 PM";

            /* Start the printer */
            //$logo = EscposImage::load(public_path("images/logos/logo.png"), false);
            $printer = new Printer($connector, $profile);

            /* Print top logo */
            /*if ($profile->getSupportsGraphics()) {
            $printer->graphics($logo);
            }
            if ($profile->getSupportsBitImageRaster() && !$profile->getSupportsGraphics()) {
            $printer->bitImage($logo);
            }*/

            /* Name of shop */
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text("ExampleMart Ltd.\n");
            $printer->selectPrintMode();
            $printer->text("Shop No. 42.\n");
            $printer->feed();

            /* Title of receipt */
            $printer->setEmphasis(true);
            $printer->text("TICKET NUMBER \n");
            $printer->setEmphasis(false);

            /* Ticket Number */
            $printer->setEmphasis(true);
            $printer->setTextSize(8, 8);
            $printer->text("\n\n");
            $printer->text("$ticket_number \n");

            $printer->setTextSize(1, 1);
            $printer->setEmphasis(false);

            /* Footer */
            $printer->feed(2);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("Thank you for shopping\n");
            $printer->text("at ExampleMart\n");
            $printer->text("For trading hours,\n");
            $printer->text("please visit example.com\n");
            $printer->feed(2);
            $printer->text($date . "\n");

          

            /* Cut the receipt and open the cash drawer */
            $printer->cut();
            $printer->pulse();

        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            $printer->close();
        }
    }

}
