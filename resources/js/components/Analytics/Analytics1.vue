<template>
    <div class="chart_1">
        <line-chart :chart-data="datacollection"></line-chart>
    </div>
</template>

<script>
    import LineChart from '../charts/LineChart'

    export default {
        components: {LineChart},
        name: "Rpt1",
        data() {
            return {
                datacollection: {},
                weights:[],
                hip:[],
                waist:[],
                labels:[],
                bmi_value:[],
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
                            label: 'Your Weight',
                            backgroundColor: 'red',
                            borderColor: 'red',
                            data: this.weights
                        }, {
                            fill: false,
                            label: 'Your Hip Size',
                            backgroundColor: 'blue',
                            borderColor: 'blue',
                            data: this.hip
                        },{
                            fill: false,
                            label: 'Your Waist Size',
                            backgroundColor: 'green',
                            borderColor: 'green',
                            data: this.waist
                        },{
                            fill: false,
                            borderDash: [5,5],
                            label: 'BMI',
                            backgroundColor: 'black',
                            borderColor: 'black',
                            data: this.bmi_value
                        }

                    ]
                }
            },
            getDataAnalytics() {
                axios.post('/analytics/analytics-1')
                    .then(({data}) => {
                        console.log(data);
                        this.weights = data.map(d => d.weight_kg);
                        this.hip = data.map(d => d.hip);
                        this.waist = data.map(d => d.waist);
                        this.bmi_value = data.map(d => d.bmi_value);
                        this.labels = data.map(d => moment(d.created_at).format('MMM D,YY'));
                        this.fillData()
                    });
            }
        }
    }
</script>

<style scoped>
</style>