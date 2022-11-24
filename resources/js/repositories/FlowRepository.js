import Repository from './Repository.js';

const resourceURI = '/flows';
function singleResourceURI(resourceURI, id) {
    return `${resourceURI}/${id}`;
}
function includeAssociations(resourceURI, includeTaskOrders, includeTasks) {
    const includes = [];

    if (includeTaskOrders) {
        includes.push('taskOrders');
    }
    if (includeTasks) {
        includes.push('tasks');
    }

    return (includes.length > 0)
        ? `${resourceURI}?include=` + includes.join()
        : resourceURI;
}

function buildParams (includeTaskOrders = false, includeTasks = false) {
    const includes = [];

    if (includeTaskOrders) {
        includes.push('taskOrders');
    }
    if (includeTasks) {
        includes.push('tasks');
    }

    return {
        ...(includes.length > 0 && { include: includes.join() })
    };
}

function buildConfig(includeTaskOrders = false, includeTasks = false) {
    const params = buildParams(includeTaskOrders, includeTasks);

    return {
        ...(params != {} && { params })
    };
}

export default {
    get(includeTaskOrders = false, includeTasks = false) {
        const config = buildConfig(includeTaskOrders, includeTasks);

        return Repository.get(resourceURI, config);
    },
    createFlow(payload) {
        return Repository.post(resourceURI, payload);
    },
    getFlow(flowId, includeTaskOrders = false, includeTasks = false) {
        const config = buildConfig(includeTaskOrders, includeTasks);

        return Repository.get(singleResourceURI(resourceURI, flowId), config);
    },
    updateFlow(flowId, payload) {
        return Repository.put(singleResourceURI(resourceURI, flowId), payload);
    },
    deleteFlow(flowId) {
        return Repository.delete(singleResourceURI(resourceURI, flowId))
    },
};
