import apiClient from "../http-common";

class ClienteDataService {
    async get(id) {
        return await apiClient.get(`/cliente/${id}`);
    }
    async criar(data) {
        console.log(JSON.stringify(data));
        return await apiClient.post("/cliente", data);
    }
    async update(id, data) {
        return await apiClient.put(`/cliente/${id}`, data);
    }
    async getAll() {
        return await apiClient.get(`/cliente`);
    }
    async delete(id) {
        return await apiClient.delete(`/cliente/${id}`);
    }
    async search(data) {
        console.log(JSON.stringify(data));
        return await apiClient.post("/search", data);
    }
}

export default new ClienteDataService();
