<?php

use App\database\tables\CoinPortfolio;


// Данные для графика
$labels = [];
$realPriceInvestmentData = [];
$investmentData = [];

function getLabels(array &$coinsData): array
{
    return array_map(function ($coin) {
        return strtoupper($coin['symbol']);
    }, $coinsData);
}

function getRealPriceInvestmentData(array &$coinsData): array
{
    return array_map(function ($coin) {
        return $coin['real_price_investment'];
    }, $coinsData);
}

function getInvestmentData(array &$coinsData): array
{
    return array_map(function ($coin) {
        return $coin['investment'];
    }, $coinsData);
}

function chart(): void
{
    global $labels, $realPriceInvestmentData, $investmentData;

    [$portfolioId, $userId, $searchName, $sort, $filterPrice] = getDataSetting();

    // Получение данных
    $coinPortfolio = new CoinPortfolio();

    $coinsData = $coinPortfolio->getCoinsForPortfolio(
        $portfolioId,
        $userId,
        $searchName,
        $sort,
        $filterPrice
    );

    if (is_null($coinsData)) {
        return;
    }

    $labels = getLabels($coinsData);
    $realPriceInvestmentData = getRealPriceInvestmentData($coinsData);
    $investmentData = getInvestmentData($coinsData);
}

chart();
?>
<section class="chart">
    <canvas id="myChart"></canvas>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [
                {
                    label: "Real cost, $",
                    backgroundColor: "#2cf83f",
                    data: <?php echo json_encode($realPriceInvestmentData); ?>
                },
                {
                    label: "Invested, $",
                    backgroundColor: "#2979FF",
                    data: <?php echo json_encode($investmentData); ?>
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>
