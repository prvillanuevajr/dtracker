<template>
    <div class="card">
        <div class="card-body">
            <h4 class="font-weight-bold">
                My Previous Diagnosis
            </h4>
            <div v-for="diagnosis in diagnoses" class="d_card card mb-2" @click="viewDiagnosis(diagnosis)">
                <div class="card-body">
                    <b>{{toFormattedDateString(diagnosis.created_at)}}</b><br>
                    Diagnosed Disease: <b>{{diagnosis.disease.name}}</b><br>
                    <div class="short_description">{{diagnosis.disease.short_description}}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MyDiagnoses",
        data() {
            return {
                diagnoses: []
            }
        },
        mounted() {
            this.getAll()
        },
        methods: {
            getAll() {
                axios.post('/diagnose/diagnosis/getAllDiagnosis')
                    .then(res => this.diagnoses = res.data)
            },
            viewDiagnosis(diagnosis) {
                window.location.replace(`/diagnose/diagnosis/${diagnosis.id}`)
            },
            toFormattedDateString(date) {
                return moment(date).format("MMM Do YY");
            }
        }
    }
</script>

<style scoped>
    .d_card:hover {
        background: rgba(0, 0, 0, .2);
        cursor: pointer;
    }

    .short_description {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>