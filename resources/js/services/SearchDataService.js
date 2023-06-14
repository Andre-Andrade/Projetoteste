import apiClient from "../http-common";

class SearchDataService {
    async search(data) {
        console.log("vvvv");
        console.log(JSON.stringify(data));
        return await apiClient.post("/search", data);
    }
}

export default new SearchDataService();
