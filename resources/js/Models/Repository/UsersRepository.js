import AbstractGraphQLRepository from "./AbstractGraphQLRepository";
import User from "../User";


export default class UsersRepository extends AbstractGraphQLRepository {
    static get resource() {
        return 'users';
    }

    static get fields() {
        return [
            'id',
            'name'
        ];
    }

    static get relations() {

    }

    /**
     * @param {User|null} entity
     */
    constructor(entity = null) {
        super(entity || User);
    }
}