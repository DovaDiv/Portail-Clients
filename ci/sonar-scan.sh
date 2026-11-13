#!/bin/bash
set -e

echo "Installing SonarScanner..."

SONAR_SCANNER_VERSION="8.2.0.6438"

curl -sSLo sonar-scanner.zip \
"https://binaries.sonarsource.com/Distribution/sonar-scanner-cli/sonar-scanner-cli-${SONAR_SCANNER_VERSION}-linux-x64.zip"

unzip -o sonar-scanner.zip

export PATH="$PWD/sonar-scanner-${SONAR_SCANNER_VERSION}-linux-x64/bin:$PATH"

echo "Running SonarQube analysis..."

sonar-scanner \
  -Dsonar.projectKey=DovaDiv_Portail-Clients \
  -Dsonar.organization=dovadiv \
  -Dsonar.projectName=Portail-Clients \
  -Dsonar.sources=index.html,css,js,php \
  -Dsonar.sourceEncoding=UTF-8 \
  -Dsonar.qualitygate.wait=true \
  -Dsonar.host.url=https://sonarcloud.io
