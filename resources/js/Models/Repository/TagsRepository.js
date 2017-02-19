import AbstractGraphQLRepository from "./AbstractGraphQLRepository";
import Tag from "../Tag";


export default class TagsRepository extends AbstractGraphQLRepository {
    static get resource() {
        return 'tags';
    }

    static get fields() {
        return [
            'id',
            'name',
            'color'
        ];
    }

    static get relations() {

    }

    /**
     * @param {User|null} entity
     */
    constructor(entity = null) {
        super(entity || Tag);
    }
}