import Article from "../Article";
import OneToOne from "../Relations/OneToOne";
import TagsRepository from "./TagsRepository";
import OneToMany from "../Relations/OneToMany";
import UsersRepository from "./UsersRepository";
import AbstractGraphQLRepository from "./AbstractGraphQLRepository";


export default class ArticlesRepository extends AbstractGraphQLRepository {
    static get resource() {
        return 'articles';
    }

    static get fields() {
        return [
            'id',
            'title',
            'image',
            'url',
            'published_at',
            'preview',
        ];
    }

    static get relations() {
        return {
            'user': new OneToOne(new UsersRepository, OneToOne.FETCH_EAGER),
            'tags': new OneToMany(new TagsRepository, OneToMany.FETCH_EAGER)
        };
    }

    /**
     * @param {Article|null} entity
     */
    constructor(entity = null) {
        super(entity || Article);
    }
}