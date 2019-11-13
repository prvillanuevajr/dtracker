<template>
    <div class="container-fluid">
        <div class="col-md-12">
            <h3>Diagnose</h3>

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h4>Input Your Body Stats.</h4>
                            </div>
                            <div class="form-group row my-4">
                                <label for="height" class="col-md-4 col-form-label text-center">Height</label>
                                <input id="height" class="form-control col-md-7" type="text" v-model="height"
                                       placeholder="Your height in centimeter">
                            </div>
                            <div class="form-group row my-4">
                                <label for="weight" class="col-md-4 col-form-label text-center">Weight</label>
                                <input id="weight" class="form-control col-md-7" type="text" v-model="weight"
                                       placeholder="Your weight in kilograms">
                            </div>
                            <div class="form-group row my-4">
                                <label for="waist" class="col-md-4 col-form-label text-center">Waist Line</label>
                                <input id="waist" class="form-control col-md-7" type="text" v-model="waist"
                                       placeholder="Your waist line in inches">
                            </div>
                            <div class="form-group row my-4">
                                <label for="hip" class="col-md-4 col-form-label text-center">Hip Size</label>
                                <input id="hip" class="form-control col-md-7" type="text" v-model="hip"
                                       placeholder="Your hip size in inches">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <input type="text" class="form-control text-right" v-model="symptom_input"
                                   placeholder="Any symptoms you are feeling right now?">
                            <div class="row mt-4">
                                <div class="col-md-6 symptom_div selected_symptom_div">
                                    <h5>Selected Symptoms</h5>
                                    <span class="badge badge-dark m-1"
                                          @click="deselect_symptom(selected_symptom,index)"
                                          v-for="selected_symptom,index in selected_symptoms">
                                        {{selected_symptom.name}}
                                    </span>
                                </div>
                                <div class="col-md-5 symptom_div">
                                    <span class="badge badge-secondary m-1"
                                          @click="select_symptom(symptom,index)"
                                          v-for="symptom,index in filtered_symptoms">
                                        {{symptom.name}}
                                    </span>
                                </div>
                            </div>
                            <form v-on:submit.prevent="on_submit" action="/diagnose/get_diagnosis" method="post">
                                <button @mouseenter="checkForm" type="submit" class="btn btn-success float-right mt-4">
                                    Get Diagnosis
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Diagnose",
        data() {
            return {
                laravel_token: null,
                symptoms: [],
                weight: null,
                height: null,
                hip: null,
                waist: null,
                selected_symptoms: [],
                symptom_input: "",
            }
        },
        mounted() {
            this.get_symptoms();
            this.laravel_token = laravel_csrf
        },
        methods: {
            get_symptoms() {
                axios.post('/diagnose/get_symptoms_all'
                ).then(({data}) => {
                    this.symptoms = data
                })
            },
            select_symptom(symptom, index) {
                this.selected_symptoms.push(symptom)
                this.symptoms.splice(index, 1);
                this.symptom_input = ''
            },
            deselect_symptom(selected_symptom, index) {
                this.symptoms.push(selected_symptom)
                this.selected_symptoms.splice(index, 1);
            },
            checkForm() {
                if (this.selected_symptoms && this.weight && this.height && this.hip && this.waist) {

                    return true
                }
                swal.fire(
                    'Incomplete details!',
                    'Body Stats and Symptoms are required!',
                    'question'
                )
            },
            on_submit() {
                swal.fire({
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    title: 'Auto close alert!',
                    html: 'I will close in <b></b> milliseconds.',
                    onBeforeOpen: () => {
                        swal.showLoading()
                    }
                })
                axios.post('/diagnose/get_diagnosis', {
                    weight: this.weight,
                    height: this.height,
                    waist: this.waist,
                    hip: this.hip,
                    symptoms: this.selected_symptoms.map(s => s.id)
                })
                    .then(data =>
                        swal.fire({
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            title: 'Please Wait!',
                            text: 'Gathering BMI Records',
                            timer: 500,
                            onBeforeOpen: () => {
                                swal.showLoading()
                            }
                        }).then(e => window.location.replace(`/diagnose/diagnosis/${data.data.diagnosis_id}`))
                    ).then(data => console.log(data))
                    .catch(error => {
                        swal.close();
                        swal.fire('Opps!', error.response.data.message, 'error')
                    })
            }
        },
        computed: {
            filtered_symptoms() {
                return this.symptoms.sort((s1, s2) => {
                    return s1.name.toLowerCase() < s2.name.toLowerCase() ? -1 : 1
                }).filter(s => s.name.toLowerCase().match(this.symptom_input.toLowerCase()))
            }
        }
    }
</script>

<style scoped>
    .form-control {
        border-style: none none solid none;
        outline-style: none;
        box-shadow: none;
    }

    .badge-primary:hover {
        background-color: #babbdc
    }

    .symptom_div {
        overflow-y: scroll;
        max-height: 300px;
    }

    .card-body {
        overflow: hidden;
    }

    ::-webkit-scrollbar {
        display: none;
    }

    .badge {
        font-size: 12px;
        color: #fff;
        cursor: pointer;
    }

    .selected_symptom_div .badge {
        display: block;
        font-size: 15px;
    }
</style>