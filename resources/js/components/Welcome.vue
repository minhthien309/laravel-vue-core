<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a-button type="primary" @click="goToPage()">
                            Primary
                        </a-button>
                    </div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
        },
        methods: {
            goToPage: function(){
                this.$router.push({path: 'page'})
            }
        }
    }
</script>