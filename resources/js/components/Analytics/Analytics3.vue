<template>
    <div class="chart_1">
        <bar-chart :chart-data="datacollection" :options="chart_options"></bar-chart>
    </div>
</template>

<script>
    import BarChart from '../charts/BarChart'

    export default {
        components: {BarChart},
        name: "Analytics3",
        data() {
            return {
                datacollection: {},
                freq_count: [],
                labels: [],
                chart_options: {
                    scales: {
                        yAxes: [{
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                min: 0,
                            },
                        }],
                        xAxes: [{
                            stacked: true,
                            ticks: {
                                beginAtZero: true,
                                categoryPercentage: 0.5,
                                barPercentage: 1,
                            },
                        }],
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                },
            }
        },
        mounted() {
            this.getDataAnalytics()
        },
        methods: {
            fillData() {
                this.datacollection = {
                    labels: this.labels,
                    datasets: [
                        {
                            fill: false,
                            label: 'disease times reported',
                            backgroundColor: 'red',
                            borderColor: 'red',
                            data: this.freq_count
                        },
                    ]
                }
            },
            getDataAnalytics() {
                axios.post('/analytics/analytics-3')
                    .then(({data}) => {
                        console.log(data);
                        this.freq_count = data.map(d => d.freq_count);
                        this.labels = data.map(d => d.name);
                        this.fillData()
                    });
            }
        }
    }
</script>

<style scoped>
</style>