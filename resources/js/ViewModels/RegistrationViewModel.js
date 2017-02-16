export default class RegistrationViewModel {
    /**
     * @type {[*]}
     */
    errors = [
        {id: 'repeat', message: 'Пароли не совпадают', visible: ko.observable(false)},
        {id: 'password_required', message: 'Пароль не может быть пустым', visible: ko.observable(false)},
    ];

    /**
     * @type {KnockoutObservable<T>}
     */
    passwordVisible = ko.observable(false);

    /**
     * @type {KnockoutObservable<T>}
     */
    name = ko.observable('')
        .extend({required: true, minLength: 2});

    /**
     * @type {KnockoutObservable<T>}
     */
    email = ko.observable('')
        .extend({
            required: true,
            pattern: {
                message: 'E-mail не похож на настоящий',
                params: '^.+@.+\..{2,}$'
            }
        });

    /**
     * @type {{original: KnockoutObservable<T>, repeat: KnockoutObservable<T>, matched: KnockoutObservable<T>}}
     */
    password = {
        original: ko.observable(''),
        repeat: ko.observable('')
    };

    constructor() {
        this.password.original.subscribe(e => {
            let password = (this.password.original() || '').toString();

            this._validate('password_required', password.length > 0);
            this._passwordCompare();
        });

        this.password.repeat.subscribe(e => {
            let password = (this.password.repeat() || '').toString();

            this._validate('password_required', password.length > 0);
            this._passwordCompare();
        });
    }

    togglePasswordVisibility() {
        this.passwordVisible(!this.passwordVisible());

        return false;
    }

    /**
     * @param key
     * @param status
     * @private
     */
    _validate(key, status) {
        for (let error of this.errors) {
            if (error.id === key) {
                error.visible(!status);
            }
        }
    }

    /**
     * @private
     */
    _passwordCompare() {
        if (this.password.original() && this.password.repeat()) {
            this._validate('repeat', this.password.original() === this.password.repeat());
        }
    }


    register() {
        for (let field of [this.password.original, this.password.repeat, this.email, this.name]) {
            field.notifySubscribers();
        }

        for (let error of this.errors) {
            if (error.visible()) {
                document.location = '#';
                return false;
            }
        }

        return true;
    }
}