import StickyPanelViewModel from "./StickyPanelViewModel";
import ArticlesRepository from "../Models/Repository/ArticlesRepository";

export default class ArticleListViewModel {
    /**
     * @type {number}
     */
    articlesPerPage = 10;

    /**
     * @type {KnockoutObservable<T>}
     */
    page = ko.observable(0);

    /**
     * @type {ArticlesRepository}
     */
    repo = new ArticlesRepository;

    /**
     * @type {KnockoutObservableArray<T>}
     */
    articles = ko.observableArray([]);

    /**
     * @type {KnockoutObservable<T>}
     */
    loading = ko.observable(false);

    /**
     * @param root
     */
    constructor(root) {
        this.aside = new StickyPanelViewModel(root);

        this.fetchNextPage();
    }

    /**
     * @return {ArticleListViewModel}
     */
    async fetchNextPage() {
        this.loading(true);

        this.page(this.page() + 1);

        try {
            let articles = await this.repo.get(this.articlesPerPage, this.page());

            for (let article of articles) {
                this.articles.push(article);
            }
        } catch (e) {
            throw e;
        } finally {
            this.loading(false);
        }

        return this;
    }
}