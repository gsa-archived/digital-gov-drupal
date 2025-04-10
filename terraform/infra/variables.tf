variable "cloudgov_organization" {
  description = "The organization for the cloud.gov account."
  type        = string
  sensitive   = true
}

variable "cloudgov_production_space" {
  description = "The production space for the cloud.gov project."
  type        = string
  sensitive   = true
}

variable "gsa_auth_key" {
  description = "API token for GSA auth SSO."
  type        = string
  sensitive   = true
}

variable "github_organization" {
  description = "The organization to use with GitHub."
  type = string
  default = "GSA"
}

variable "cloudgov_password" {
  description = "The password for the cloud.gov account."
  type        = string
  sensitive   = true
}

variable "cloudgov_username" {
  description = "The username for the cloudfoundry account."
  type        = string
  sensitive   = true
}

variable "github_token" {
  description = "The token used authenticate with GitHub."
  type        = string
  sensitive   = true
}

variable "mtls_port" {
  description = "The default port to direct traffic to. Envoy proxy listens on 61443 and redirects to 8080, which the application should listen on."
  type        = number
  default     = 61443
}

variable "newrelic_key" {
  description = "The API key for New Relic."
  type        = string
  sensitive   = true
}

variable "terraform_working_dir" {
  description = "Working directory for Terraform."
  type = string
  default = "digital-gov-drupal/terraform"
}
