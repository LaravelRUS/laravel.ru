export default class LoginViewModel {
    /**
     * @type {KnockoutObservable<T>}
     */
    passwordVisible = ko.observable(false);

    /**
     * @return {boolean}
     */
    togglePasswordVisibility() {
        this.passwordVisible(!this.passwordVisible());

        return false;
    }
}