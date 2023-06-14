<template>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Relatorio de Usuario</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">email</th>
                                        <th scope="col">
                                            <button>
                                                <router-link
                                                    class="btn btn-outline-primary"
                                                    :to="{
                                                        name: 'novousuario',
                                                    }"
                                                >
                                                    Novo
                                                </router-link>
                                            </button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- v-for="reembolsos in usuario"
                                        :key="reembolsos.id" -->
                                    <tr
                                        v-for="(
                                            usuario, index
                                        ) in usuarios.data"
                                        :key="index"
                                    >
                                        <th scope="row">{{ usuario.id }}</th>
                                        <!-- <td>{{ //usuario.pays.nom }}</td> -->
                                        <td>{{ usuario.nome }}</td>
                                        <td>{{ usuario.email }}</td>
                                        <td>
                                            <button>
                                                <router-link
                                                    class="btn btn-outline-primary"
                                                    :to="{
                                                        name: 'editausuario',
                                                        params: {
                                                            id: usuario.id,
                                                        },
                                                    }"
                                                >
                                                    Editar
                                                </router-link>
                                            </button>
                                            &nbsp;
                                            <button
                                                @click="
                                                    deletarUsuario(usuario.id)
                                                "
                                                role="link"
                                                class="btn btn-outline-danger"
                                            >
                                                Deletar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- <pagination-component
                            :items="items"
                            :per-page="perPage"
                            @page-changed="currentPage = $event"
                        /> -->
                        <Bootstrap5Pagination
                            :data="usuarios"
                            @pagination-change-page="list"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
//import Paginate from "vuejs-paginate-next";
import UsuarioDataService from "@/services/UsuarioDataService";
//import PaginationComponent from "@xmehdi01/vue-pagination-component";
//import pagination from "laravel-vue-pagination";
import { Bootstrap5Pagination } from "laravel-vue-pagination";
//import pagination from "vuejs-paginate-next";
export default {
    name: "usuarios",
    components: {
        //   pagination,
        Bootstrap5Pagination,
    },
    data() {
        return {
            // usuario: [],
            // reembolsos: {
            //     type: Object,
            //     default: null,
            // },
            usuarios: [],
            perPage: 3,
            currentPage: 1,
            // users: {
            //     type: Object,
            //     default: null,
            // },
        };
    },
    mounted() {
        this.list();
    },
    methods: {
        async list(page = 1) {
            await axios
                .get(`/api/usuario?page=` + page)
                .then(({ data }) => {
                    console.log(data);
                    this.usuarios = data;
                })
                .catch(({ response }) => {
                    console.error(response);
                });
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
                console.log("222222222222ss");
            } catch (error) {
                console.log(error);
            }
        },
    },
};
</script>

<style scoped>
.pagination {
    margin-bottom: 0;
}
</style>
