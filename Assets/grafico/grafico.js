google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawCharts);


function drawCharts() {
    drawChartInt();
    drawChartCli();
    drawChartAge();
}

// Redesenha os gráficos quando a janela é redimensionada
window.addEventListener('resize', drawCharts);


function drawChartInt(){
    var dataInt = google.visualization.arrayToDataTable([
        ['Mês', 'Novos Intérpretes'],
        ['Janeiro', 0], ['Fevereiro', 0], ['Março', 0], ['Abril', 0], 
        ['Maio', 0], ['Junho', 0], ['Julho', 0], ['Agosto', 0], 
        ['Setembro', 0], ['Outubro', 0], ['Novembro', 0], ['Dezembro', 0]
    ]);

    var dadosInt = window.dadosInt; // Obtém os dados passados do PHP
    updateGraphData(dataInt, dadosInt);

    var optionsInt = {
        title: 'Quantidade de Novos Intérpretes por Mês',
        chartArea: {width: '50%'},
        hAxis: {title: 'Mês', slantedText: true},
        vAxis: {
            title: 'Total de Intérpretes', 
            minValue: 0, // Garante que o gráfico comece de 0
            ticks: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] // Define os valores de 1 em 1
        },
        bars: 'vertical'
    };
    var chartInt = new google.visualization.ColumnChart(document.getElementById('chart_interpretes'));
    chartInt.draw(dataInt, optionsInt);
}

function drawChartCli() {
    // Gráfico de Novos CLIENTES
    var dataCli = google.visualization.arrayToDataTable([
        ['Mês', 'Novos Clientes'],
        ['Janeiro', 0], ['Fevereiro', 0], ['Março', 0], ['Abril', 0], 
        ['Maio', 0], ['Junho', 0], ['Julho', 0], ['Agosto', 0], 
        ['Setembro', 0], ['Outubro', 0], ['Novembro', 0], ['Dezembro', 0]
    ]);

    var dadosCli = window.dadosCli; // Obtém os dados passados do PHP
    updateGraphData(dataCli, dadosCli);

    var optionsCli = {
        title: 'Quantidade de Novos Clientes por Mês',
        chartArea: {width: '50%'},
        hAxis: {title: 'Mês', slantedText: true},
        vAxis: {
            title: 'Total de Clientes', 
            minValue: 0, // Garante que o gráfico comece de 0
            ticks: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] // Define os valores de 1 em 1
        },
        bars: 'vertical'
    };
    var chartCli = new google.visualization.ColumnChart(document.getElementById('chart_clientes'));
    chartCli.draw(dataCli, optionsCli);


}

function drawChartAge() {
    var dataAge = google.visualization.arrayToDataTable([
        ['Mês', 'Novos agendamentos'],
        ['Janeiro', 0], ['Fevereiro', 0], ['Março', 0], ['Abril', 0], 
        ['Maio', 0], ['Junho', 0], ['Julho', 0], ['Agosto', 0], 
        ['Setembro', 0], ['Outubro', 0], ['Novembro', 0], ['Dezembro', 0]
    ]);

    var dadosAge = window.dadosAge; // Obtém os dados passados do PHP
    updateGraphData(dataAge, dadosAge);

    var optionsAge = {
        title: 'Quantidade de Novos agendamentos por Mês',
        chartArea: {width: '50%'},
        hAxis: {title: 'Mês', slantedText: true},
        vAxis: {
            title: 'Total de agendamentos', 
            minValue: 0, // Garante que o gráfico comece de 0
            ticks: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10] // Define os valores de 1 em 1
        },
        bars: 'vertical'
    };
    var chartAge = new google.visualization.ColumnChart(document.getElementById('chart_agendamentos'));
    chartAge.draw(dataAge, optionsAge);
}


// Função auxiliar para atualizar os dados no gráfico
function updateGraphData(data, dadosPHP) {
    for (var i = 0; i < dadosPHP.length; i++) {
        var mes = dadosPHP[i][0];
        var total = dadosPHP[i][1];
        for (var j = 0; j < data.getNumberOfRows(); j++) {
            if (data.getValue(j, 0) == mes) {
                data.setValue(j, 1, total);
            }
        }
    }
}
