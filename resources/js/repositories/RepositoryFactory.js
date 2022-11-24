import FlowRepository from "./FlowRepository.js";

const repositories = {
    flows: FlowRepository,
};

export const RepositoryFactory = {
    get: name => repositories[name]
};
