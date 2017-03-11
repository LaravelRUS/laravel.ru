import Relation from "./Relation";

export default class OneToOne extends Relation {
    /**
     * @param item
     * @param {T} model
     * @param {object} relations
     * @return {T}
     */
    static wrap(item, model, relations = {}) {
        for (let relation of Object.keys(relations)) {
            item[relation] = this.wrapRelation(item, relation, relations[relation]);
        }

        return new model(item);
    }
}