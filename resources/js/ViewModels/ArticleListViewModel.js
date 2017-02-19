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
        this.page(this.page() + 1);

        let articles = await this.repo.get(this.articlesPerPage, this.page());

        for (let article of articles) {
            this.articles.push(article);
        }

        return this;
    }
}