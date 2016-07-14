if (_.isUndefined(window.vc)) var vc = {
    atts: {}
};
if (function($) {
        var WpsVcColumnOffsetParam = Backbone.View.extend({
            events: {},
            $lg_offset_placeholder_value: !1,
            $lg_size_placeholder_value: !1,
            initialize: function() {
                _.bindAll(this, "setLgPlaceholders")
            },
            render: function() {
                return this
            },
            save: function() {
                var data = [];
                return this.$el.find(".wps_vc_column_offset_field").each(function() {
                    var $field = $(this);
                    $field.is(":checkbox:checked") ? data.push($field.attr("name")) : $field.is("select") && "" !== $field.val() && data.push($field.val())
                }), data
            },
            setLgPlaceholders: function() {
                var offset = this.$lg_offset_placeholder_value.val().replace(/[^\d]/g, "");
                this.$lg_size.find("option:first").text(WpsVcI8nColumnOffsetParam.inherit_default), this.$lg_offset.find("option:first").text(offset ? WpsVcI8nColumnOffsetParam.inherit + offset : "")
            }
        });
        vc.atts.wps_column_offset = {
            parse: function(param) {
                var $field = this.content().find("input.wpb_vc_param_value." + param.param_name),
                    wps_column_offset = $field.data("WPSvcColumnOffset"),
                    result = wps_column_offset.save();
                return result.join(" ")
            },
            init: function(param, $field) {
                $('[data-column-offset="true"]', $field).each(function() {
                    var $this = $(this),
                        $field = $this.find(".wpb_vc_param_value");
                    $field.data("WPSvcColumnOffset", new WpsVcColumnOffsetParam({
                        el: $this
                    }).render())
                })
            }
        }
    }(window.jQuery), _.isUndefined(window.vc)) var vc = {
    atts: {}
};
