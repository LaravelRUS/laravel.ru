import Relation from "./Relation";

export default class OneToMany extends Relation {
    /**
     * @param data
     * @param {T} entity
     * @param {object} relations
     * @return {Array<T>}
     */
    static wrap(data, entity, relations = {}) {
        let result = [];

        for (let item of data) {
            for (let relation of Object.keys(relations)) {
                item[relation] = this.wrapRelation(item, relation, relations[relation]);
            }

            result.push(new entity(item));
        }

        return result;
    }
}