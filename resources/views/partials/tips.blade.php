<section class="tips hidden" data-vm="TipsViewModel"
         data-bind="css: { hidden: !visible() }">

    @{{#if tipOfDay}}
        <h3>
            Знаете ли вы?

            <a href="#" data-bind="click: close" class="tip-close"
                title="Не показывать"></a>
        </h3>
        <article class="tip-content">
            @{{{ tipOfDay().content }}}
        </article>
        <footer>
            <a href="#" data-bind="click: dislike" class="tip-thumbs-up" title="Шикарно!">
                @{{ tipOfDay().likes }}
            </a>

            <a href="#" data-bind="click: like" class="tip-thumbs-down" title="Ниочень">
                @{{ tipOfDay().dislikes }}
            </a>

            <a href="#" data-bind="click: nextTip" class="tip-show-next"
               title="Просто покажи мне следующий"></a>

            <span class="tips-count">
                @{{ 11 - tips().length }} / 10
            </span>
        </footer>
    @{{/if}}
</section>