# CONFIGURATION
#
# First - call all entities
# > php bin/console d:s:u --force
#
# Second - load data fixures
# > php bin/console doctrine:fixtures:load
# > yes
#
# Now you can login via https://127.0.0.1:8000/login
# login: admin@admin.com
# password: admin123
#
# Third - set new ReCaptcha Keys in .env file
# GOOGLE_RECAPTCHA_SITE_KEY=
# GOOGLE_RECAPTCHA_SECRET=
#
# ...