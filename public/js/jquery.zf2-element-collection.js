 /**
 * JQuery plugin to create dynamic add/remove capabilties upon a fieldset created
 *  by ZF2's FormCollection.
 * @author svroy <https://github.com/svroy>
 * @link https://github.com/neilime/zf2-twb-bundle/issues/5
 */

; if (typeof Object.create !== 'function') {
    Object.create = function(obj) {
        function F() {};
        F.prototype = obj;
        return new F();
    };
}

(function($, window, document, undefined) {

    /*
     * Object Class
     * 
     */
    var Zf2ElementCollection = {
        
        init: function(options, elem) {
            var self = this;
            
            self.elem = elem;
            self.$elem = $(elem);
            
            self.options = $.extend({}, $.fn.zf2ElementCollection.defaults, options);
            
            self.count = self.$elem.data('count') ? self.$elem.data('count') : 0;
            self.add = self.$elem.data('add') ? self.$elem.data('add') : false;
            self.remove = self.$elem.data('remove') ? self.$elem.data('remove') : false;
            self.positions = [];
            self.currentCount = self.getCurrentCount();
            
            for (var i = 0; i < self.currentCount; i++) 
            {
                self.positions.push(i);
            }
            
            self.legend = (self.$elem.find("> legend").text()) ? self.$elem.find("> legend").text() : "";
            
            self.refresh();
        
        },
        
        isAddValid: function() {
            var self = this;
            self.getCurrentCount();
            
            if (self.add)
                return true;
            else
                return false;
        
        },
        
        isRemoveValid: function() 
        {
            var self = this;
            self.getCurrentCount();
            
            if (self.remove && (self.currentCount > self.count))
                return true;
            else
                return false;
        },
        
        getCurrentCount: function() 
        {
            var self = this;
            var elSelector = self.getElementSelector();
            self.currentCount = self.$elem.find(elSelector).length;
            return self.currentCount;
        },
        
        manageAddBtn: function() 
        {
            var self = this;
            if (self.isAddValid()) 
            {
                if (self.$elem.find("> a#add").length == 0) 
                {
                    var newText = self.legend + ' <a id="add" title="+" href="#" class="btn btn-small btn-success" style="display:inline-block; margin-left:20px"><i class="icon-plus"></i></a>';
                    self.$elem.find("> legend").html(newText);
                }
            } 
            else
                self.$elem.find("> a#add").fadeToggle(250).detach();
        
        },
        
        manageRemoveBtn: function() 
        {
            var self = this;
            var elSelector = self.getElementSelector();
            if (self.isRemoveValid()) 
            {
                self.$elem.find(elSelector).each(function() {
                    if ($(this).find("> a#remove").length == 0) 
                    {
                        var newItem = $('<a id="remove" title="-" href="#" class="btn pull-right btn-small btn-danger"><i class=" icon-remove"></i></a>').hide();
                        $(this).prepend(newItem);
                        newItem.fadeToggle(250);
                    }
                });
            } 
            else {
                self.$elem.find(elSelector + " > a#remove").fadeToggle(250).detach();
            }
        },
        
        addObject: function() {
            var self = this;
            
            if (self.isAddValid()) 
            {
                var template = self.$elem.find('> span').data('template');
                
                for (var i = 0; i < self.currentCount; i++) 
                {
                    if (self.positions.indexOf(i) == -1) 
                    {
                        break;
                    }
                }
                
                template = template.replace(/__index__/g, i);
                self.positions.push(i);
                var newItem = $(template).hide();
                
                
                self.$elem.append(newItem);
                newItem.fadeToggle(500);
            
            }
            self.refresh();
        },

        /**
         * Figures out the selector for the individual elements in the collection.
         * @returns {string} E.g. '> fieldset' or '> input.someclass'
         */
        getElementSelector: function() {
            var self = this;
            
            // Return cached.
            if (self.options.elementSelector) {
                return self.options.elementSelector;
            }
            
            var templateStr = self.$elem.find('> [data-template]').data('template'),
                    testEl = $(templateStr),
                    selector = '> ';
            
            // Return fallback in case of an empty template.
            if (!testEl.length) {
                return self.options.elementSelector = selector + '*';
            }
            
            selector += testEl[0].localName;
            // Use the first class if there is one.
            var classes = testEl.attr('class');
            if (classes) {
                var firstClass = classes.trim().split(/\s+/)[0];
                if (firstClass) {
                    selector += '.' + firstClass;
                }
            }
            
            delete testEl;
            
            return self.options.elementSelector = selector;
        },
        
        removeObject: function($element) {
            var self = this;
            var elSelector = self.getElementSelector();
            
            if (self.isRemoveValid()) 
            {

                //self.positions index()
                var index = self.$elem.find(elSelector).index($element);
                
                self.positions = jQuery.grep(self.positions, function(value) {
                    return value != index;
                });
                
                $element.fadeToggle(500).detach();
            }
            
            self.refresh();
        },
        
        refresh: function() {
            var self = this;
            var elSelector = self.getElementSelector();
            
            self.manageAddBtn();
            self.manageRemoveBtn();
            
            self.$elem.find("> legend > a#add").click(function(e) {
                e.preventDefault();
                
                self.addObject();
            });
            
            
            self.$elem.find(elSelector + " > a#remove").click(function(e) {
                e.preventDefault();
                
                self.removeObject($(this).parent());
            });
            
            //self.hideLegend();
        }
    };

    /*
     * Constructor
     *    
     */
    $.fn.zf2ElementCollection = function(options) {
        return this.each(function() {
            
            var zf2ElementCollection = $.data(this, 'zf2ElementCollection');
            if (!zf2ElementCollection) {
                zf2ElementCollection = Object.create(Zf2ElementCollection);
                
                if (typeof options === 'object' || !options) {
                    zf2ElementCollection.init(options, this);
                    return;
                } 
                else
                    zf2ElementCollection['init'].apply(this, Array.prototype.slice.call(arguments, 1));
                $.data(this, 'zf2ElementCollection', zf2ElementCollection);
            } else 
            {
                if (zf2ElementCollection[options]) {
                    zf2ElementCollection[options].apply(this, Array.prototype.slice.call(arguments, 1));
                } else if (typeof options === 'object' || !options) {
                    zf2ElementCollection.init(options, this);
                } else {
                    $.error('Method ' + options + ' does not exist on jQuery.zf2ElementCollection');
                }
            }
        
        
        });
    };
    
    $.fn.zf2ElementCollection.defaults = {};
}
)(jQuery, window, document);
