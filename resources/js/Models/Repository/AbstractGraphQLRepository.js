import AbstractRepository from "./AbstractRepository";
import OneToMany from "../Relations/OneToMany";

export default class AbstractGraphQLRepository extends AbstractRepository {
    /**
     * @param _limit
     * @param _page
     * @return {Promise.<void>}
     */
    async get(_limit = null, _page = null) {
        let url = router.action('graphql.query');

        let response = await fetch(url, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                query: this._buildGetQuery(_limit, _page)
            })
        });

        let data = await response.json();

        let items = OneToMany.parseResponse(data, this.constructor.resource);

        items.map(entity => {
            if (_page) {
                entity._page = _page;
            }
        });


        return OneToMany.wrap(items, this.entity, this.constructor.relations);
    }

    /**
     * @param limit
     * @param page
     * @return {string}
     * @private
     */
    _buildGetQuery(limit, page) {
        let query = OneToMany.buildQuery(
            this.constructor.resource,
            this.constructor.fields,
            {
                _limit: limit,
                _page: page
            },
            this.constructor.relations
        );

        return `query { \n ${query} \n }`;
    }
}