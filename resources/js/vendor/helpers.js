function Component(params) {
    return viewModel => {
        ko.components.register(params.name, {
            viewModel: viewModel,
            template: params.template
        })
    }
}


(global || window).Component = Component;
