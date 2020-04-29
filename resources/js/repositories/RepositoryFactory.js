import FlowRepository from "./FlowRepository";

const repositories = {
    flows: FlowRepository,
};

export const RepositoryFactory = {
    get: name => repositories[name]
};
