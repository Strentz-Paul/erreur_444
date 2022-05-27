SYMFONY_ENV_DEV = .env.local
SYMFONY_ENV_PROD = .env.prod.local

help: ## Display available commands
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

build-assets: ## Build assets (minimized) for production
	yarn encore production

build-assets-watch: ## Build assets for dev in watch mode
	yarn encore dev --watch

default: help
