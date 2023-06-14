import apiClient from "../http-common";

class UsuarioDataService {
    async conectar(data) {
        return await apiClient.post("/conectar", data);
    }
    async deconnecter() {
        return await apiClient.post("/deconnexion");
    }
    async get(id) {
        return await apiClient.get(`/usuario/${id}`);
    }
    async criar(data) {
        //  console.log(JSON.stringify(data));
        console.log(data);
        return await apiClient.post("/registrar", data);
    }
    async update(id, data) {
        return await apiClient.put(`/usuario/${id}`, data);
    }
    async getAll() {
        return await apiClient.get(`/usuario`);
    }
    async delete(id) {
        return await apiClient.delete(`/usuario/${id}`);
    }
}

export default new UsuarioDataService();
