import Repository from './Repository.js';

const resourceURI = '/flows';
function singleResourceURI(resourceURI,id) {
    return `${resourceURI}/${id}`;
}
export default {
    get() {
        return Repository.get(resourceURI);
    },
    createFlow(payload) {
        return Repository.post(resourceURI, payload);
    },
    getFlow(flowId) {
        return Repository.get(singleResourceURI(resourceURI, flowId));
    },
    updateFlow(flowId, payload) {
        return Repository.put(singleResourceURI(resourceURI, flowId), payload);
    },
    deleteFlow(flowId) {
        return Repository.delete(singleResourceURI(resourceURI, flowId))
    },
};
