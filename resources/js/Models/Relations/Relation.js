export default class Relation {
    static FETCH_EAGER = 'eager';
    static FETCH_LAZY = 'lazy';

    /**
     * @type {Function|null}
     */
    _repo = null;

    /**
     * @type {string}
     */
    fetch = Relation.FETCH_LAZY;

    /**
     * @param {Function} repository
     * @param {string} fetch
     */
    constructor(repository, fetch = Relation.FETCH_LAZY) {
        this._repo = repository;
        this.fetch = fetch;
    }

    /**
     * @return {AbstractGraphQLRepository}
     */
    get repository() {
        return this._repo;
    }

    /**
     * @param resource
     * @param fields
     * @param criteria
     * @param relations
     * @return {string}
     */
    static buildQuery(resource, fields, criteria = {}, relations = {}) {
        let query = this._buildCriterionQuery(criteria);

        fields = fields.concat(this._buildRelationsSubQuery(relations));

        return `${resource}${query}{\n${fields.join("\n")}\n}`;
    }

    /**
     * @param relations
     * @return {Array}
     * @private
     */
    static _buildRelationsSubQuery(relations = {}) {
        let result = [];

        for (let field of Object.keys(relations)) {
            let relation = relations[field];

            if (relation.fetch !== Relation.FETCH_EAGER) {
                continue;
            }

            let relationRepo = relation.repository;

            result.push(this.buildQuery(field, relationRepo.constructor.fields))
        }

        return result;
    }

    /**
     * @param criteria
     * @return {string}
     * @private
     */
    static _buildCriterionQuery(criteria = {}) {
        if (Object.keys(criteria).length === 0){
            return '';
        }

        // Build array of criteria strings
        let stringifyArgs = [];

        for (let criterion of Object.keys(criteria)) {
            let value = criteria[criterion];
            if (value === null || typeof value === 'undefined') {
                continue;
            }
            stringifyArgs.push(`${criterion}: ${value.toString()}`);
        }

        // Build query
        let query = '';

        if (stringifyArgs.length > 0) {
            query = `(${stringifyArgs.join(', ')})`;
        }

        return query;
    }

    /**
     * @param {object} response
     * @param {string} resourceName
     */
    static parseResponse(response, resourceName) {
        if (response.errors) {
            for (let error of response.errors) {
                console.error(error.message);
            }

            throw new Error('GraphQL request error');
        }

        if (!response.data[resourceName]) {
            throw new Error('Response has no available data');
        }

        return response.data[resourceName];
    }

    /**
     * @param data
     * @param model
     * @param relations
     */
    static wrap(data, model, relations = {}) {
        throw new TypeError('Can not call an abstract method wrap');
    }

    /**
     * @param {object} data
     * @param {string} field
     * @param {Relation} relation
     * @return {null}
     */
    static wrapRelation(data, field, relation) {
        if (!data[field]) {
            return null;
        }

        let repo = relation.repository;

        return relation.constructor.wrap(data[field], repo.entity, {});
    }
}