import Tip from "../Tip";
import OneToOne from "../Relations/OneToOne";
import UsersRepository from "./UsersRepository";
import AbstractGraphQLRepository from "./AbstractGraphQLRepository";


export default class TipsRepository extends AbstractGraphQLRepository {
    static get resource() {
        return 'tips';
    }

    static get fields() {
        return [
            'id',
            'content',
            'content_source',
            'likes',
            'dislikes',
        ];
    }

    static get relations() {
        return {
            'user': new OneToOne(new UsersRepository, OneToOne.FETCH_LAZY),
        };
    }

    /**
     * @param {Tip|null} entity
     */
    constructor(entity = null) {
        super(entity || Tip);
    }
}