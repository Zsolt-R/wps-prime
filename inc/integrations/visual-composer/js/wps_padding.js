if (_.isUndefined(window.vc)) var vc = {
    atts: {}
};
if (function($) {
        var WpsVcPaddingParam = Backbone.View.extend({
            events: {},
            $lg_padding_value: !1,
            $lg_size_placeholder_value: !1,
            initialize: function() {
                _.bindAll(this, "setLgPlaceholders")
            },
            render: function() {
                return this
            },
            save: function() {
                var data = [];
                return this.$el.find(".wps_vc_padding_field").each(function() {
                    var $field = $(this);
                    $field.is(":checkbox:checked") ? data.push($field.attr("name")) : $field.is("select") && "" !== $field.val() && data.push($field.val())
                }), data
            },
            setLgPlaceholders: function() {
                var offset = this.$lg_padding_value.val().replace(/[^\d]/g, "");
                this.$lg_size.find("option:first").text(WpsVcI8nPaddingParam.inherit_default), this.$lg_offset.find("option:first").text(offset ? WpsVcI8nPaddingParam.inherit + offset : "")
            }
        });

        // Parameter type MUST match the ones defined here
        vc.atts.wps_padding = {
            parse: function(param) {
                var $field = this.content().find("input.wpb_vc_param_value." + param.param_name),
                    wps_padding = $field.data("WPSvcPadding"),
                    result = wps_padding.save();
                return result.join(" ")
            },
            init: function(param, $field) {
                $('[data-padding="true"]', $field).each(function() {
                    var $this = $(this),
                        $field = $this.find(".wpb_vc_param_value");
                    $field.data("WPSvcPadding", new WpsVcPaddingParam({
                        el: $this
                    }).render())
                })
            }
        }
    }(window.jQuery), _.isUndefined(window.vc)) var vc = {
    atts: {}
};