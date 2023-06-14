<template>
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div
                class="row d-flex justify-content-center align-items-center h-100"
            >
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header text-center">
                            <h2>Edita Usuario {{ formid }}</h2>
                        </div>
                        <p
                            v-if="errorserver"
                            class="block text-md text-red-500"
                        >
                            {{ errorserver }}
                        </p>
                        <form @submit.prevent="actioneditausuario">
                            <!--<p class="text-center">Please login to your account</p>-->

                            <div class="card-body p-md-5 mx-md-4">
                                <div>
                                    <p>Nome</p>
                                    <input
                                        type="text"
                                        v-model="formnome"
                                        id="formnome"
                                        class="form-control"
                                        placeholder="n"
                                    />
                                    <p></p>
                                </div>

                                <div>
                                    <p>Emails</p>
                                    <input
                                        type="email"
                                        v-model="formemail"
                                        id="formemail"
                                        class="form-control"
                                        placeholder=""
                                    />
                                    <p></p>
                                </div>
                                <div>
                                    <p>Password</p>
                                    <input
                                        type="password"
                                        v-model="formpassword"
                                        id="formpassword"
                                        class="form-control"
                                        placeholder="*************"
                                    />
                                    <p
                                        v-if="v$.formpassword.$error"
                                        class="block text-md text-red-500"
                                    >
                                        Digite uma password válida
                                    </p>
                                </div>
                                <div>
                                    <p>Confirme a password</p>
                                    <input
                                        type="password"
                                        v-model.trim="formpassword_confirmation"
                                        id="formpassword_confirmation"
                                        class="form-control"
                                        placeholder="*************"
                                    />
                                    <p
                                        v-if="
                                            v$.formpassword_confirmation.$error
                                        "
                                        class="block text-md text-red-500"
                                    >
                                        A confirmação é diferente da password
                                    </p>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="button">
                                    <router-link
                                        class="bg-white focus:ring-4 border-2 font-medium rounded-md text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:focus:ring-blue-800"
                                        :to="{
                                            name: 'relatoriousuario',
                                        }"
                                    >
                                        Voltar</router-link
                                    ></button
                                >&nbsp;
                                <button
                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                    type="submit"
                                >
                                    Atualizar</button
                                >&nbsp;
                                <button
                                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                                    type="button"
                                    @click="
                                        deletarUsuario(this.$route.params.id)
                                    "
                                >
                                    Deletar</button
                                ><br />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { useVuelidate } from "@vuelidate/core";
import { required, minLength, email, sameAs } from "@vuelidate/validators";
import UsuarioDataService from "@/services/UsuarioDataService";

export default {
    name: "EditaUsuarioView",
    async mounted() {
        await this.getusuario(this.$route.params.id);
    },
    setup() {
        return {
            v$: useVuelidate(),
        };
    },
    data() {
        return {
            formnome: "",
            formemail: "",
            formpassword: "",
            formpassword_confirmation: "",
            errorserver: "",
        };
    },
    validations() {
        return {
            formnome: { required },
            formemail: { required, email },
            formpassword: { minLength: minLength(3) },
            formpassword_confirmation: {
                // minLength: minLength(3),
                sameAsPassword: sameAs(this.formpassword),
            },
        };
    },
    methods: {
        checkForm(e) {
            this.$v.user.$touch();
            // For accessibility: focusing on the field with an error
            if (this.$v.user.$invalid) {
                e.preventDefault();
                for (let key in Object.keys(this.$v.user)) {
                    const input = Object.keys(this.$v.user)[key];
                    if (input.includes("$")) return false;
                    if (this.$v.user[input].$error) {
                        this.$refs[input].focus();
                        break;
                    }
                }
                this.submitStatus = "ERROR";
            } else {
                return true;
            }
        },
        // Soumission du formulaire
        actioneditausuario: async function () {
            console.log("fdfdfd");

            this.v$.$touch(); // Déclenche la validation

            if (this.v$.$invalid) {
                // Si le formulaire est invalide, arrêtez le processus de soumission

                this.errorserver = "";
                console.log("3333");
                return;
            }

            try {
                this.$emit("loading:start");
                await UsuarioDataService.update(this.$route.params.id, {
                    nome: this.formnome,
                    email: this.formemail,
                    password: this.formpassword,
                    password_confirmation: this.formpassword_confirmation,
                });
                this.$router.push({ name: "relatoriousuario" });
                this.errorserver = "";
            } catch (erro) {
                this.errorserver = erro.response.data.erro;
            } finally {
                this.$emit("loading:end");
            }
        },
        getusuario: async function () {
            this.$emit("loading:start");
            try {
                //   console.log("dddggggdddd");
                const reponse = await UsuarioDataService.get(
                    this.$route.params.id
                );
                console.log(reponse.data);
                //    console.log("ddddddd" + this.$route.params.id);
                this.formnome = reponse.data.usuario.nome;
                this.formemail = reponse.data.usuario.email;
                //   this.formpassword = reponse.data.usuario.password;
                //   this.formpassword_confirmation = reponse.data.usuario.password;
                return reponse.data;
            } catch (error) {
                // console.log("dddfffffffffffdddd");
                console.error(error);
            } finally {
                this.$emit("loading:end");
            }
        },
        async deletarUsuario(usuariosid) {
            try {
                if (confirm("Deseja deletar usuario id:" + usuariosid)) {
                    const response = await UsuarioDataService.delete(
                        usuariosid
                    );
                    this.usuario = response.data;
                }
                console.log(response.data);
                this.$router.push({ name: "relatoriousuario" });
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>
