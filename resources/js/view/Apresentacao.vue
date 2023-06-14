<template>
    <section class="h-100 gradient-form" style="background-color: #eee">
        <div class="container py-5 h-100">
            <div
                class="row d-flex justify-content-center align-items-center h-100"
            >
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="card-body p-md-5 mx-md-4">
                                    <h3 class="text-center" style="color: blue">
                                        Cadastro de Clientes
                                    </h3>
                                    <p></p>
                                    <br />

                                    <h4 class="text-center">
                                        Gerencie todos os contatos de seus
                                        clientes
                                    </h4>

                                    <div class="text-center">
                                        <img
                                            src="https://api.freelogodesign.org/assets/thumb/logo/5301_400.png"
                                            style="width: 250px"
                                            alt="logo"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: "add-category",
    data() {
        return {
            category: {
                title: "",
                description: "",
            },
        };
    },
    methods: {
        async create() {
            await this.axios
                .post("/api/category", this.category)
                .then((response) => {
                    this.$router.push({ name: "categoryList" });
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
