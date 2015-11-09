#!/bin/bash

if [ "$1" == "" ]; then
  echo "Usage: $0 locale -- Example: $0 es_ES"
  exit 1
fi

# Example: es_ES
locale="$1"

plugin_dir="../"
locale_dir="$(pwd)"

# This wil create messages.po in the same dir as this sh file.
find $plugin_dir -name "*.php" | xargs xgettext --keyword="__" --keyword="_e" --from-code="utf-8"

prev_messages="$locale_dir/mucaptcha-$locale.po"
old_messages="$locale_dir/$locale-old.po"

if [ -f $prev_messages ]; then
  cp $prev_messages $old_messages
  msgmerge --lang $locale --update --no-fuzzy-matching $old_messages messages.po
  mv $old_messages $prev_messages
  rm messages.po
else
  mv messages.po $prev_messages
fi

# Update default charset.
sed -i 's|CHARSET|UTF-8|g' $prev_messages
