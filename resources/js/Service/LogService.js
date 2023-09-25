import axios from "axios";

/**
 * @returns {Array}
*/
async function findLogs() {
    const result = await axios.get('/api/log/find-all');
    if (result.status == 200) {
        return result.data;
    } else {
        return [];
    }
}

async function findLog(log) {
    const result = await axios.get(`/api/log/find?id=${log.id}`);
    if (result.status == 200) {
        return result.data;
    } else {
        return null;
    }
}

async function patchLog(log) {
    await axios.patch("/api/log/update", {
        log
    });
}

async function storeLog(log) {
    return await axios.post('/api/log/create', log);
}

async function deleteLog(log) {
    return await axios.delete(`/api/log/delete?id=${log.id}`);
}

export {
    findLogs,
    patchLog,
    storeLog,
    deleteLog,
    findLog,
}
