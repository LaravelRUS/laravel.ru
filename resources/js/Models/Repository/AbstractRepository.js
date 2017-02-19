export default class AbstractRepository {
    /**
     * @type {string}
     */
    static get resource() {
        return '';
    };

    /**
     * @type {Array|string[]}
     */
    static get fields() {
        return [];
    }

    /**
     * @return {{}}
     */
    static get relations() {
        return {};
    }

    /**
     * @type {Function}
     */
    entity = null;

    /**
     * @param {Function} entity
     */
    constructor(entity) {
        this.entity = entity;
    }

    /**
     * @param _limit
     * @param _page
     */
    async get(_limit = null, _page = null) {
        throw new Error('Method get are not allowed');
    }
}