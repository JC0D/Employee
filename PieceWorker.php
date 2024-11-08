<?php
require_once 'Employee.php';

class PieceWorker extends Employee
{
    private $pieceProduced;
    private $wagePerPiece;

    public function __construct($name, $address, $age, $company, $pieceProduced, $wagePerPiece)
    {
        parent::__construct($name, $address, $age, $company);
        $this->pieceProduced = $pieceProduced;
        $this->wagePerPiece = $wagePerPiece;
    }

    public function earning()
    {
        return $this->pieceProduced * $this->wagePerPiece; // Calculates earnings for pieceworker
    }

    public function __toString()
    {
        return parent::__toString() . "\nPiece Produced: {$this->pieceProduced} \nwage per Piece: " . number_format($this->wagePerPiece, 2);
    }
}
