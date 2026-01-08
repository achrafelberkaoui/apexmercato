<?php
namespace ClassFinal;
final class FinancialEngine
{
    private float $taxRate = 0.10;     
    private float $agentFeeRate = 0.05;


    public function calculateTotalCost(float $price): float
    {
        $tax = $price * $this->taxRate;
        $agentFee = $price * $this->agentFeeRate;

        return $price + $tax + $agentFee;
    }

    public function canAfford(float $price, float $teamBudget): bool
    {
        $totalCost = $this->calculateTotalCost($price);
        return $teamBudget >= $totalCost;
    }

}
